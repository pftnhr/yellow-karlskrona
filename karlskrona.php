<?php
// Karlskrona extension, https://github.com/pftnhr/yellow-karlskrona

class YellowKarlskrona {
    const VERSION = "0.8.18";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }
    
    // Handle update
    public function onUpdate($action) {
        $fileName = $this->yellow->system->get("coreExtensionDirectory").$this->yellow->system->get("coreSystemFile");
        if ($action=="install") {
            $this->yellow->system->save($fileName, array("theme" => "karlskrona"));
        } elseif ($action=="uninstall" && $this->yellow->system->get("theme")=="karlskrona") {
            $this->yellow->system->save($fileName, array("theme" => $this->yellow->system->getDifferent("theme")));
        }
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $themeLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("CoreThemeLocation");
            $output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$themeLocation}karlskrona.js\"></script>\n";
        }
        return $output;
    }
}
