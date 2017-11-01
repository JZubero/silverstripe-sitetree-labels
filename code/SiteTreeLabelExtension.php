<?php

class SiteTreeLabelExtension extends DataExtension {

    private static $show_labels = true;

    private static $many_many = [
        'Labels' => SiteTreeLabel::class
    ];

    public function updateSettingsFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Settings', GridField::create('Labels', _t('SiteTreeLabel.LABELS', 'Label'), $this->owner->Labels(),
            GridFieldConfig_RelationEditor::create()));
    }

    /**
     * Fetches all assigned site tree labels.
     *
     * @return ArrayList
     */
    public function SiteTreeLabels() {
        $labels = ArrayList::create();

        // Return empty ArrayList if labels are deactivated
        if (!$this->doShowLabels())
            return $labels;

        // Add Menu Labels if available and activated
        if ($this->doShowMenuLabels())
            foreach (MenuItem::get()->filter('PageID', $this->owner->ID) as $menuItem) {
                $labels->add([
                    'Title' => $menuItem->MenuSet()->Name,
                    'Color' => singleton('SiteTreeLabel')->getDefaultColor()
                ]);
            }

        // Add page's labels
        $labels->merge($this->owner->Labels()->toArray());

        return $labels;
    }

    /**
     * Checks if labels are activated.
     *
     * @return bool
     */
    private function doShowLabels() {
        return Config::inst()->get('SiteTree', 'show_labels') === true;
    }

    /**
     * Checks for HeyDay's Menu Manager Module and the flag for activating it.
     *
     * @return bool
     */
    private function doShowMenuLabels() {
        return class_exists('MenuItem') && class_exists('MenuSet') && Config::inst()->get('SiteTreeLabel', 'show_menu_labels');
    }
}