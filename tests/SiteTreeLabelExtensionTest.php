<?php

class SiteTreeLabelExtensionTest extends SapphireTest
{
    protected static $fixture_file = [
        'sitetree-labels.yml'
    ];

    public function testSiteTreeHasSiteTreeLabelExtensionApplied()
    {
        $siteTree = SiteTree::create();

        $hasExtensionApplied = $siteTree->hasExtension('SiteTreeLabelExtension');

        $this->assertTrue($hasExtensionApplied, 'SiteTree should have SiteTreeLabelExtension applied');
    }

    public function testSiteTreeLabelsReturnsEmptyListWhenSwitchedOff()
    {
        Config::inst()->update('SiteTree', 'show_labels', false);

        $pageWithLabels = $this->objFromFixture('Page', 'two-labels');

        /** @var ArrayList $labels */
        $labels = $pageWithLabels->SiteTreeLabels();

        $this->assertEquals(0, $labels->count(), 'SiteTreeLables() should no labels when switched off');
    }

    public function providePagesAndLabels()
    {
        return [
            'no-labels' => [
                'no-labels',
                []
            ],
            'one-label' => [
                'one-label',
                [
                    ['Title' => 'Label 1']
                ]
            ],
            'two-labels' => [
                'two-labels',
                [
                    ['Title' => 'Label 1'],
                    ['Title' => 'Label 2']
                ]
            ]
        ];
    }


    /**
     * @dataProvider providePagesAndLabels
     * @param $pageFixtureName
     * @param $expectedResult
     */
    public function testSiteTreeLabelsReturnsArrayListWhenSwitchedOn($pageFixtureName, $expectedResult)
    {
        $page = $this->objFromFixture('Page', $pageFixtureName);

        $labels = $page->SiteTreeLabels();

        $this->assertDOSEquals($expectedResult, $labels);
    }
}
