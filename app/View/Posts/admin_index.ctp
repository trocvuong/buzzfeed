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
            <h2><i class="icon-calendar"></i> List News</h2>
        </div>
        <?php echo $this->Session->flash(); ?>
        <div class="action">
            <?php echo $this->Html->link('Add', array('controller'=>'Posts', 'action'=>'add'), array('class'=>'btn btn-success')); ?>
        </div>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th width="12%">Username</th>
                    <th width="6%">Category</th>
                    <th width="27%">Title</th>
                    <th width="25%">Sumary</th>
                    <th width="15%">Date post</th>
                    <th width="15%" class="nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $data) {
                        ?>
                        <tr>
                            <td>
                                <?php echo h($list_user[$data['Post']['user_id']]); ?>
                            </td>
                            <td>
                                <?php echo h($category[$data['Post']['category_id']]); ?>
                            </td>
                            <td>
                                <?php echo h($data['Post']['title']) ?>
                            </td>
                            <td class="center">
                                <?php echo $data['Post']['summary']; ?>
                            </td>
                            <td class="center">
                                <?php echo $data['Post']['date']; ?>
                            </td>
                            <td class="center nowrap">

                                <?php
                                if(empty($data['Post']['approved'])){
                                    echo $this->Html->link('<i class="icon-zoom-in icon-white"></i>
                                                            </span> ', array('controller' => 'Posts',
                                        'action' => 'edit', $data['Post']['id']), array('escape' => false, 'class' => 'btn btn-success'));
                                    echo ' ';
                                    echo $this->Form->postLink('<i class="icon-trash icon-white"></i></span>',array('controller' => 'Posts', 'action' => 'delete', $data['Post']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Do you want delete this account %s?', $data['Post']['id']));
                                    echo ' ';
                                    echo $this->Form->postLink('<i class="icon-check icon-white"></i></span>',array('controller' => 'Posts', 'action' => 'approved', $data['Post']['id']), 
                                        array(
                                            'escape' => false,
                                            'class' => 'btn btn-warning'),
                                            __('Do you want approved?'));
                                }else{
                                    echo $this->Form->postLink('<i class="icon-remove icon-white"></i> Unapproved</span>',array('controller' => 'Posts', 'action' => 'unapproved', $data['Post']['id']), array('escape' => false, 'class' => 'btn btn-warning'), __('Do you want unapproved this account %s?', $data['Post']['id']));
                                }
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
