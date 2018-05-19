<?php

use Faker\Generator;

class ProductCategoriesCest
{
    /**
     * @var Generator $fakeData
     */
    protected $fakeData;

    /**
     * @var integer $fakeDataSeed
     */
    protected $fakeDataSeed;

    /**
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I)
    {
        if (!$this->fakeData) {
            $this->fakeData = Faker\Factory::create();
        }

        $this->fakeDataSeed = rand(0, 2048);
        $this->fakeData->seed($this->fakeDataSeed);
    }

    /**
     * @param \AcceptanceTester $I
     * @param \Step\Acceptance\ListView $listView
     * @param \Step\Acceptance\ProductCategories $productCategories
     * @param \Helper\WebDriverHelper $webDriverHelper
     *
     * As an administrator I want to view the productCategories module.
     */
    public function testScenarioViewProductCategoriesModule(
        \AcceptanceTester $I,
        \Step\Acceptance\ListView $listView,
        \Step\Acceptance\ProductCategories $productCategories,
        \Helper\WebDriverHelper $webDriverHelper
    ) {
        $I->wantTo('View the productCategories module for testing');

        $I->amOnUrl(
            $webDriverHelper->getInstanceURL()
        );

        // Navigate to productCategories list-view
        $I->loginAsAdmin();
        $productCategories->gotoProductCategories();
        $listView->waitForListViewVisible();

        $I->see('ProductCategories', '.module-title-text');
    }
}