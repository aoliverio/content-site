<?php

/**
 * 
 */
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * 
 */
$this->layout('page_2cl');
$this->CmsContent = TableRegistry::get('Content.CmsContent');
$this->SysUser = TableRegistry::get('System.SysUser');

/**
 * Text pattern
 */
$SEARCH = isset($this->request->data['search']) ? trim($this->request->data['search']) : NULL;

/**
 * Risultato Pagine
 */
$query = $this->CmsContent->find('all');
$query->where(['content_type' => 'page', 'content_status' => 'publish', 'content_title LIKE' => '%' . $SEARCH . '%']);
$risultato_pagine = $query->toArray();

/**
 * Risultato Notizie
 */
$query = $this->CmsContent->find('all');
$query->where(['content_type' => 'news', 'content_status' => 'publish', 'content_title LIKE' => '%' . $SEARCH . '%']);
$risultato_notizie = $query->toArray();

/**
 * Risultato Docenti
 */
$query = $this->SysUser->find('all');
$query->where(['name LIKE' => '%' . $SEARCH . '%']);
$risultato_docenti = $query->toArray();
?>
<h1 class="page-header"><?= $data->content_title; ?></h1>
<div>
    <?= $data->content_description; ?>
</div>
<pre>Testo ricercato: <?= $SEARCH; ?></pre>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Pagine <span class="badge"><?= count($risultato_pagine) ?></span></a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Notizie <span class="badge"><?= count($risultato_notizie) ?></span></a></li>
        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Docenti <span class="badge"><?= count($risultato_docenti) ?></span></a></li>
    </ul>
    <br/>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
            <p><strong>Elenco Pagine:</strong></p>
            <?php foreach ($risultato_pagine as $row): ?>
                <div class="well well-sm">
                    <h4><a href="<?= $this->Url->build([$row->name]); ?>"><?= $row->content_title; ?></a></h4>
                </div>
            <?php endforeach; ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
            <p><strong>Elenco Notizie:</strong></p>
            <?php foreach ($risultato_notizie as $row): ?>
                <div class="well well-sm">
                    <h4><a href="<?= $this->Url->build([$row->name]); ?>"><?= $row->content_title; ?></a></h4>
                </div>
            <?php endforeach; ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
            <p><strong>Elenco Docenti:</strong></p>
            <?php foreach ($risultato_docenti as $row): ?>
                <div class="well well-sm">
                    <h4><a href="#"><?= $row->name; ?></a></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>