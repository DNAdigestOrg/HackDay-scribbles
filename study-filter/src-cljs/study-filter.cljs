(ns study-filter
  (:require [dommy.utils :as utils]
            [dommy.core :as dom]
            [clojure.string :as str]
            [apogee.charts :as charts]
            [apogee.svg :as svg])
  (:use-macros [dommy.macros :only [node sel sel1]]))

(def data (atom []))
(def data-uri "study-filter-data.txt")

(defn xhr-text [uri]
  "Quick'n'dirty synchronous HTTP request"
  (let [x (js/XMLHttpRequest.)]
    (.open x "GET" uri false)
    (.send x)
    (.-responseText x)))

(defn init []
  (doseq [l (rest (str/split-lines 
                   (xhr-text data-uri)))]
    (let [[id name subset study sex age race] (str/split l #"\t")]
      (swap! data conj {:id id
                        :name name
                        :subset subset
                        :study study
                        :sex (keyword sex)
                        :age (js/parseInt age)
                        :race race}))))

(defn make-filter [str]
  (if (empty? str)
    (fn [s] true)
    (fn [s]
      (<= 0 (max (.indexOf (:study s) str)
                 (.indexOf (:name s) str)
                 (.indexOf (:race s) str))))))


(defn search []
  (let [holder (sel1 "#holder")
        input-field (sel1 "input")
        search-string (.-value input-field)
        samples (filter (make-filter search-string) @data)
        gdata (into {} (take 10 (group-by :study samples)))]
    (dom/clear! holder)
    (doseq [[study samples] gdata]      
      (let [chart-node (node [:div {:class "graph-holder"}])]
        (dom/set-html! chart-node (age-histogram samples))
        (dom/append! holder
                     (node [:p [:h4 (str study)]
                            (str (count samples) " samples")
                            chart-node]))))))

(defn age-histogram [samples]
  (let [ages (frequencies (filter #(not (js/isNaN %)) 
                                  (map :age samples)))]
    (charts/emit-svg
     (-> (charts/xy-plot :width 150 :height 80
                         :xmin 0 :xmax 100
                         :ymin 0 :ymax 20)
         (charts/add-points (sort-by first ages))))))
