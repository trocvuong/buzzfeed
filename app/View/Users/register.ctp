<div>
    <div class="col-md-8">
        <h3><b>Register User</b></h3>
        <hr>

        <!-- <form class="form-horizontal" role="form"> -->
        <?php echo $this->Form->create('User', array('class'=>'form-horizontal', 'role'=>'form')) ?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('email', array('type'=>'email', 'class'=>'form-control col-md-6', 'placeholder'=>'Email', 'div'=>false, 'label'=>false, 'required'=>true)) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('password', array('type'=>'password', 'class'=>'form-control col-md-6', 'placeholder'=>'Password', 'div'=>false, 'label'=>false, 'required'=>true)) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('confirmPassword', array('type'=>'password', 'class'=>'form-control', 'placeholder'=>'Confirm password', 'div'=>false, 'label'=>false, 'required'=>true)) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Full name</label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('fullname', array('type'=>'text', 'class'=>'form-control', 'placeholder'=>'Full name', 'div'=>false, 'label'=>false, 'required'=>true)) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <?php echo $this->Form->submit('Register', array('class'=>'btn btn-primary', 'type'=>'submit')) ?>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="col-md-4">
        <?php echo $this->element('column2_view', array('news' => $news_col)) ?>
    </div>
</div>