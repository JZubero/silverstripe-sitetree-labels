<?php

class SiteTreeLabelExtension extends DataExtension {

    private static $show_labels = true;

    private static $label_color = '#426ef4';

    private static $many_many = [
        'Labels' => SiteTreeLabel::class
    ];

    public function updateSettingsFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Settings', GridField::create('Labels', _t('SiteTreeLabel.LABELS', 'Label'), $this->owner->Labels(),
            GridFieldConfig_RelationEditor::create()));
    }

    public function SiteTreeLabels() {
        if (Config::inst()->get('SiteTree', 'show_labels') == false) return null;

        $labels = [];

        // Check for HeyDay's Menu Manager Module
        if (class_exists('MenuItem') &&
            class_exists('MenuSet'))
            foreach (MenuItem::get()->filter('PageID', $this->owner->ID) as $menuItem) {
                $labels[] = [
                    'Title' => $menuItem->MenuSet()->Name,
                    'Color' => Config::inst()->get('SiteTree', 'label_color')
                ];
            }

        // Add page's labels
        $labels = array_merge($labels, $this->owner->Labels()->toArray());

        $this->owner->extend('updateSiteTreeLabels', $labels);

        return count($labels) === 0 ? null : ArrayList::create($labels);
    }
}