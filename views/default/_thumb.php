<li class="span3">
    <span class="thumbnail" rel="tooltip" data-title="<?php echo "#" . $data->id ?>">

    <p>
        <?php
        $this->widget(
            'bootstrap.widgets.TbButtonGroup',
            array(
                 'size' => 'mini',
                 'buttons' => array(
                     array(
                         'icon' => 'eye-open',
                         'url'  => array(
                             'p3Media/view',
                             'id'        => $data->id,
                             'returnUrl' => $this->createUrl("", $_GET)
                         ),
                     ),
                     array(
                         'icon' => 'pencil',
                         'url'  => array(
                             'p3Media/update',
                             'id'        => $data->id,
                             'returnUrl' => $this->createUrl("", $_GET)
                         )
                     ),
                     array(
                         'icon' => 'info-sign',
                         'url'  => array(
                             'p3MediaMeta/update',
                             'id'        => $data->id,
                             'returnUrl' => $this->createUrl("", $_GET)
                         )
                     ),
                     array(
                         "type"        => "danger",
                         "icon"        => "icon-remove icon-white",
                         "htmlOptions" => array(
                             "submit"  => array(
                                 "p3Media/delete",
                                 "id"        => $data->id,
                                 "returnUrl" => $_SERVER['REQUEST_URI']
                             ),
                             "confirm" => Yii::t('P3MediaModule.crud', 'Do you want to delete this item?')
                         )
                     )
                 )
            )
        );

        ?>
    </p>

        <div class="thumbnail-wrapper">
            <?php
            echo CHtml::link(
                CHtml::image(
                    Yii::app()->controller->createUrl(
                        "/p3media/file/image",
                        array("id" => $data->id, "preset" => "p3media-manager")
                    ),
                    $data->title,
                    array("class" => "280x180")
                ),
                array('p3Media/update', 'id' => $data->id, 'returnUrl' => $this->createUrl(''))
            );
            ?>
        </div>

        <div class="ui-helper-clearfix"></div>
    <h5>
        <i class="icon-tag"></i>
        <?php
        $this->widget(
            'EditableField',
            array(
                 'type'      => 'text',
                 'model'     => $data,
                 'attribute' => 'title',
                 'url'       => $this->createUrl('/p3media/p3Media/ajaxUpdate'),
            )
        );

        ?>
    </h5>
<p>
    <i class="icon-folder-close"></i>
    <?php
    // TODO: remove 'if'
    if ($data->metaData) {
        $this->widget(
            'EditableField',
            array(
                 'type'      => 'select',
                 'model'     => $data->metaData,
                 'attribute' => 'treeParent_id',
                 'url'       => $this->createUrl('/p3media/p3MediaMeta/ajaxUpdate'),
                 'source'    => $this->directoriesList,
                 'emptytext' => Yii::t('app','Select Folder')
            )
        );
    } else {
        echo Yii::t('P3MediaModule.crud', 'No meta data');
    }
    ?>
</p>
</li>