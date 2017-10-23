<?php

class SiteTreeLabelReport extends SS_Report {

    public function title() {
        return _t('SiteTreeLabel.REPORT_TITLE', 'Pages with Site Tree Labels assigned');
    }

    /**
     * Shows linked pages if a certain label is specified via dropdown.
     *
     * TODO: Include implicit MenuManager Labels
     *
     * @param null $params
     *
     * @return SS_List
     */
    public function sourceRecords($params = null) {
        if (!isset($params['Label']) ||
            !($labelId = $params['Label']))
            return ArrayList::create();

        return SiteTreeLabel::get()->byID($labelId)->Pages();
    }

    public function columns() {
        return [
            'Title' => [
                'title' => 'Title',
                'link'  => true
            ]
        ];
    }

    public function parameterFields() {
        return new FieldList(
            new DropdownField('Label', _t('SiteTreeLabel.SINGULARNAME'), SiteTreeLabel::get()->sort('Title')->map())
        );
    }
}