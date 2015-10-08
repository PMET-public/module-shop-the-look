<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */


/**
 *
 * @todo make sure block/page versioning is used
 * @todo do not overwrite block/page and clear data
 * @todo fix img srcset for {{media}} directives
 *
 */

namespace MagentoEse\LookBook\Setup;

use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\Block;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Page factory
     *
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * Block factory
     *
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * Init
     *
     * @param PageFactory $pageFactory
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        PageFactory $pageFactory,
        BlockFactory $blockFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->blockFactory = $blockFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $shopTheLookContent = <<<EOD
            <div class="gallery-placeholder">
                <div class="item">
                    {{widget type="Magento\\Cms\\Block\\Widget\\Block" template="MagentoEse_LookBook::widget/static_block/default.phtml" block_id="stl_felicia_maxi_dress"}}
                </div>
                <div class="item">
                    {{widget type="Magento\\Cms\\Block\\Widget\\Block" template="MagentoEse_LookBook::widget/static_block/default.phtml" block_id="stl_tatiana_skirt"}}
                </div>
            </div>
            <script type="text/x-magento-init">
                {
                    ".gallery-placeholder": {
                        "MagentoEse_LookBook/js/lookbook": {
                            "items": 1,
                            "loop": true,
                            "singleItem": true,
                            "autoPlay": true,
                            "stopOnHover": true,
                            "navigation": false,
                            "responsive": true,
                            "autoHeight": true,
                            "mouseDrag": true,
                            "touchDrag": true
                        }
                    }
                }
            </script>
EOD;

        $shopTheLookContentData = [
            'title' => 'Shop the Look',
            'content_heading' => '',
            'page_layout' => '1column',
            'identifier' => 'look',
            'content' => $shopTheLookContent,
            'is_active' => 1,
            'stores' => [3],
            'sort_order' => 0,
            'layout_update_xml' => "
                <head>
                    <css src='MagentoEse_LookBook/css/lib/owl.carousel.min.css'/>
                    <css src='MagentoEse_LookBook/css/lib/owl.theme.default.min.css'/>
                </head>
                <referenceBlock name='breadcrumbs' remove='true'/>"
        ];

        $this->createPage()->setData($shopTheLookContentData)->save();



        $options = array(
            'mainImage' => '1_0498',
            'details' => array(
                'headline' => 'Delicious Combination',
                'subtitle' => 'Casual day or flirty night'
            ),
            'promo1' => array(
                'headline'  => 'Get Waisted',
                'subtitle'  => 'Add a belt to any ensemble for a piece of figure-flattering flair. This is easy accessorizing with huge impact.',
                'image'     => 'VA10-CT'
            ),
            'promo2' => array(
                'headline'  => 'Carmina Earrings',
                'subtitle'  => 'These gold & coral chandelier earrings are all about the drama. Take any simply-stated outfit from ho-hum to wow.',
                'image'     => 'VA11-SG'
            ),
            'promo3' => array(
                'headline'  => 'Felicia Maxi Dress',
                'subtitle'  => 'Made for wherever the day may take you',
                'image'     => 'VD04-SN'
            )
        );
        $stlFeliciaMaxiDressContent = <<<EOD
            <div class='aspot-container'>
                <div class='aspot-img'>
                    <picture>
                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
                    </picture>
                    <div class='details'>
                        <div class='headline'>{$options['details']['headline']}</div>
                        <div class='subtitle'>{$options['details']['subtitle']}</div>
                        <div class='button'>Shop This Look</div>
                    </div>
                </div>
                <div class='aspot-promo'>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo1']['headline']}</div>
                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
                            </picture>
                        </div>
                    </div>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo2']['headline']}</div>
                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
                            </picture>
                        </div>
                    </div>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo3']['headline']}</div>
                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
EOD;
        $stlFeliciaMaxiDressContent = $this->trimHereDoc($stlFeliciaMaxiDressContent);

        $options = array(
            'mainImage' => '6_1350',
            'details' => array(
                'headline' => 'Retire your LBD',
                'subtitle' => 'New sophistication. Classic style.'
            ),
            'promo1' => array(
                'headline'  => 'Augusta Earrings',
                'subtitle'  => 'Keep your cool in every situation. These silver chandelier earrings feature blues from ocean to sky.',
                'image'     => 'VA12-TS'
            ),
            'promo2' => array(
                'headline'  => 'Silver Amor Bangle Set',
                'subtitle'  => 'Made for mixing & matching, these bangles can be worn simply or with additional bracelets for a bolder look.',
                'image'     => 'VA22-SI'
            ),
            'promo3' => array(
                'headline'  => 'Flora Tank Dress',
                'subtitle'  => 'Loves to be the center of attention',
                'image'     => 'D06-MI'
            )
        );
        $stlTatianaSkirt = <<<EOD
            <div class='aspot-container'>
                <div class='aspot-img'>
                    <picture>
                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
                    </picture>
                    <div class='details'>
                        <div class='headline'>{$options['details']['headline']}</div>
                        <div class='subtitle'>{$options['details']['subtitle']}</div>
                        <div class='button'>Shop This Look</div>
                    </div>
                </div>
                <div class='aspot-promo'>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo1']['headline']}</div>
                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
                            </picture>
                        </div>
                    </div>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo2']['headline']}</div>
                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
                            </picture>
                        </div>
                    </div>
                    <div class='promo'>
                        <div class='details'>
                            <div class='headline'>{$options['promo3']['headline']}</div>
                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
                        </div>
                        <div class='image'>
                            <picture>
                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
EOD;
        $stlTatianaSkirt = $this->trimHereDoc($stlTatianaSkirt);

//        $options = array(
//            'mainImage' => '',
//            'details' => array(
//                'headline' => '',
//                'subtitle' => ''
//            ),
//            'promo1' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo2' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo3' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            )
//        );
//        $stlFloraTankDress = <<<EOD
//            <div class='aspot-container'>
//                <div class='aspot-img'>
//                    <picture>
//                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
//                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
//                    </picture>
//                    <div class='details'>
//                        <div class='headline'>{$options['details']['headline']}</div>
//                        <div class='subtitle'>{$options['details']['subtitle']}</div>
//                        <div class='button'>Shop This Look</div>
//                    </div>
//                </div>
//                <div class='aspot-promo'>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo1']['headline']}</div>
//                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo2']['headline']}</div>
//                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo3']['headline']}</div>
//                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
//                            </picture>
//                        </div>
//                    </div>
//                </div>
//            </div>
//EOD;
//        $stlFloraTankDress = $this->trimHereDoc($stlFloraTankDress);
//        $options = array(
//            'mainImage' => '',
//            'details' => array(
//                'headline' => '',
//                'subtitle' => ''
//            ),
//            'promo1' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo2' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo3' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            )
//        );
//        $stlHannaSweater = <<<EOD
//            <div class='aspot-container'>
//                <div class='aspot-img'>
//                    <picture>
//                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
//                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
//                    </picture>
//                    <div class='details'>
//                        <div class='headline'>{$options['details']['headline']}</div>
//                        <div class='subtitle'>{$options['details']['subtitle']}</div>
//                        <div class='button'>Shop This Look</div>
//                    </div>
//                </div>
//                <div class='aspot-promo'>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo1']['headline']}</div>
//                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo2']['headline']}</div>
//                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo3']['headline']}</div>
//                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
//                            </picture>
//                        </div>
//                    </div>
//                </div>
//            </div>
//EOD;
//        $stlHannaSweater = $this->trimHereDoc($stlHannaSweater);
//
//        $options = array(
//            'mainImage' => '',
//            'details' => array(
//                'headline' => '',
//                'subtitle' => ''
//            ),
//            'promo1' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo2' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo3' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            )
//        );
//        $stlHonoraWideLegPants = <<<EOD
//            <div class='aspot-container'>
//                <div class='aspot-img'>
//                    <picture>
//                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
//                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
//                    </picture>
//                    <div class='details'>
//                        <div class='headline'>{$options['details']['headline']}</div>
//                        <div class='subtitle'>{$options['details']['subtitle']}</div>
//                        <div class='button'>Shop This Look</div>
//                    </div>
//                </div>
//                <div class='aspot-promo'>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo1']['headline']}</div>
//                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo2']['headline']}</div>
//                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo3']['headline']}</div>
//                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
//                            </picture>
//                        </div>
//                    </div>
//                </div>
//            </div>
//EOD;
//        $stlHonoraWideLegPants = $this->trimHereDoc($stlHonoraWideLegPants);
//
//        $options = array(
//            'mainImage' => '',
//            'details' => array(
//                'headline' => '',
//                'subtitle' => ''
//            ),
//            'promo1' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo2' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            ),
//            'promo3' => array(
//                'headline'  => '',
//                'subtitle'  => '',
//                'image'     => ''
//            )
//        );
//        $stlVitaliaTop = <<<EOD
//            <div class='aspot-container'>
//                <div class='aspot-img'>
//                    <picture>
//                        <source srcset='{{media url='wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg'}}' media='(min-width: 1261px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_lg@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                        <source srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab.jpg"}}, {{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_tab@2x.jpg"}} 2x' media='(min-width: 401px)'>
//                        <img srcset='{{media url="wysiwyg/venia/look/aspot/VENIA_Outfit-{$options['mainImage']}_mobi@2x.jpg"}} 2x'>
//                    </picture>
//                    <div class='details'>
//                        <div class='headline'>{$options['details']['headline']}</div>
//                        <div class='subtitle'>{$options['details']['subtitle']}</div>
//                        <div class='button'>Shop This Look</div>
//                    </div>
//                </div>
//                <div class='aspot-promo'>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo1']['headline']}</div>
//                            <div class='subtitle'>{$options['promo1']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo1']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo2']['headline']}</div>
//                            <div class='subtitle'>{$options['promo2']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo2']['image']}_main@2x.jpg"}} 2x'>
//                            </picture>
//                        </div>
//                    </div>
//                    <div class='promo'>
//                        <div class='details'>
//                            <div class='headline'>{$options['promo3']['headline']}</div>
//                            <div class='subtitle'>{$options['promo3']['subtitle']}</div>
//                        </div>
//                        <div class='image'>
//                            <picture>
//                                <source srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main_sm@2x.jpg"}} 2x' media='(min-width: 771px)'>
//                                <img srcset='{{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main.jpg"}}, {{media url="wysiwyg/venia/look/promo/{$options['promo3']['image']}_main@2x.jpg"}} 2x' >
//                            </picture>
//                        </div>
//                    </div>
//                </div>
//            </div>
//EOD;
//        $stlVitaliaTop = $this->trimHereDoc($stlVitaliaTop);
//

        $shopTheLookCmsBlocks = [
            [
                'title' => 'STL - Felicia Maxi Dress',
                'identifier' => 'stl_felicia_maxi_dress',
                'content' => $stlFeliciaMaxiDressContent,
                'is_active' => 1,
                'stores' => 3
            ],
            [
                'title' => 'STL - Tatiana Skirt',
                'identifier' => 'stl_tatiana_skirt',
                'content' => $stlTatianaSkirt,
                'is_active' => 1,
                'stores' => 3
            ]
        ];

        /**
         * Insert Shop the Look Blocks
         */
        foreach ($shopTheLookCmsBlocks as $data) {
            $this->createBlock()->setData($data)->save();
        }

        $setup->endSetup();

    }

    /**
     * Create page
     *
     * @return Page
     */
    public function createPage()
    {
        return $this->pageFactory->create();
    }

    /**
     * Create block
     *
     * @return block
     */
    public function createBlock()
    {
        return $this->blockFactory->create();
    }

    function trimHereDoc($t)
    {
        return implode("", array_map('trim', explode("\n", $t)));
    }

}
