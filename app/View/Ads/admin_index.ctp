<?php
    echo $this->Html->script('/backend/js/js.backend');

    App::import('Model', 'User');
    $this->User = new User();
?>
<script type='text/javascript'>
    $(document).ready(function() {
        setTimeout(function() {
            $("#flashMessage").fadeOut().remove();
        }, 5000);
    });
</script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-calendar"></i> List Ads</h2>
        </div>
        <?php echo $this->Session->flash(); ?>
        <div class="action">
            <?php //echo $this->Html->link('Add', array('controller'=>'Users', 'action'=>'add'), array('class'=>'btn btn-success')); ?>
        </div>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Size</th>
                    <th width="40%">Content</th>
                    <th width="10%" class="nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($ads)) {
                    foreach ($ads as $data) {
                        ?>
                        <tr>
                            <td align="center">
                                <?php echo h($data['Ad']['id']) ?>
                            </td>
                            <td>
                                <?php echo h($data['Ad']['size']) ?>
                            </td>
                            <td class="center">
                                <?php echo h($data['Ad']['content']); ?>
                            </td>
                            <td class="center nowrap">
                                <?php
                                    echo $this->Html->link('<i class="icon-zoom-in icon-white"></i></span> ', array('controller' => 'Ads',
                                        'action' => 'edit', $data['Ad']['id']), array('escape' => false, 'class' => 'btn btn-success'));
                                    //echo ' ';
                                    //echo $this->Form->postLink('<i class="icon-trash icon-white"></i></span>',array('controller' => 'Ads', 'action' => 'delete', $data['User']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Do you want delete this account %s?', $data['User']['id']));

                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    <?php if ($this->Paginator->numbers()): ?>
        <div class="pagination">
            <ul>
                <?php echo '<li>' . $this->Paginator->prev(__('<<'), array(), null, array('class' => 'prev disabled')) . '</li>'; ?>
                <?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '')); ?>
                <?php echo '<li>' . $this->Paginator->next(__('>>'), array(), null, array('class' => 'next disabled')) . '</li>'; ?>
            </ul>
        </div>
    <?php endif;?>
</div>
