<?php

class SiteTreeLabel extends DataObject {

    private static $show_menu_labels = true;

    private static $db = [
        'Title' => 'Varchar',
        'Color' => 'Varchar(7)'
    ];

    private static $belongs_many_many = [
        'Pages' => SiteTree::class
    ];

    public function getCMSFields() {
        $f = parent::getCMSFields();
        $f->addFieldToTab('Root.Main', ColorField::create('Color'));

        return $f;
    }

    protected function validate() {
        $validator = parent::validate();

        // Forbid duplicate titles
        if (!$this->isInDB() &&
            SiteTreeLabel::get()->filter('Title', $this->Title)->exists())
            $validator->error(_t('SiteTreeLabel.ERROR_TITLE_EXISTS', "A label \"{title}\" exists already. Consider linking the existing one.", '', array('title' => $this->Title)));

        return $validator;
    }

    public function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);
        $labels['Title'] = _t('SiteTreeLabel.TITLE', 'Title');
        $labels['Color'] = _t('SiteTreeLabel.COLOR', 'Color');

        return $labels;
    }
}