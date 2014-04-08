(defproject study-filter "0.0.1-SNAPSHOT"
  :description "A simple example of how to use lein-cljsbuild"
  :source-paths ["src-clj"]
  :dependencies [[org.clojure/clojure "1.5.1"]
                 [org.clojure/clojurescript "0.0-2202"
                  :exclusions [org.apache.ant/ant]]
                 [prismatic/dommy "0.1.2"]
                 [org.clojars.frozenlock/apogee "0.1.1-SNAPSHOT"]]
  :plugins [[lein-cljsbuild "1.0.3"]]
  :cljsbuild {
    :builds [{:source-paths ["src-cljs"]
              :compiler {:output-to "build/main.js"
                         :optimizations :whitespace
                         :pretty-print true}}]}
  )
