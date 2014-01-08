<?php

namespace Plugin\AssetRsync;


use Ip\Response\JsonRpc;
use Symfony\Bridge\Twig\Tests\NodeVisitor\TranslationDefaultDomainNodeVisitorTest;

class AdminController extends \Ip\Controller
{
    public function index()
    {
        ipAddJs(ipFileUrl('Plugin/AssetRsync/assets/admin.js'));

        $form = new \Ip\Form();
        $form->addClass('ipsAssetRsyncOptions');

        $field = new \Ip\Form\Field\Hidden(array(
            'name' => 'aa',
            'value' => 'AssetRsync.saveOptions'
        ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Text(array(
            'name' => 'assetDestinationDirectory',
            'label' => __('Asset destination directory', 'AssetRsync'),
            'value' => ipGetOption('AssetRsync.assetDestinationDirectory'),
        ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Checkbox(array(
            'name' => 'syncOnCacheClear',
            'label' => __('Sync on cache clear', 'AssetRsync'),
            'checked' => ipGetOption('AssetRsync.syncOnCacheClear') ? true : false,
        ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Submit(array(
            'name' => 'submit',
            'value' => __('Submit', 'AssetRsync')
        ));
        $form->addField($field);

        $data = array(
            'form' => $form,
        );

        return ipView('view/options.php', $data);
    }

    public function saveOptions()
    {
        $request = ipRequest();

        // TODOX getError form

        $syncOnCacheClear = $request->getPost('syncOnCacheClear', false) ? true : false;

        ipSetOption('AssetRsync.syncOnCacheClear', $syncOnCacheClear);

        ipSetOption('AssetRsync.assetDestinationDirectory', $request->getPost('assetDestinationDirectory'));

        return JsonRpc::result(true);
    }

    public function syncAssets()
    {
        Model::syncAssets();

        return JsonRpc::result(true);
    }
}