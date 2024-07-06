<div style="background: #fff;max-width: 600px;margin:0 auto">
  <div style="background: #efefef;padding: 10px;text-align: center;">
    <img src="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('cms_logo');?>" style="width:250px">
  </div>
  <div style="padding:10px">
    <h4><?php echo @$subject;?></h4>
    <p>
      Hi, <b><?php echo @$name;?></b> contacted You<br>
      The Details Are : <br>
      Email : <?php echo @$email;?><br>
      Mobile: <?php echo @$mobile;?><br>
      Message: <?php echo @$message;?>
    </p>
    <p>
      Regards,
      <br>
      <?php echo @$this->session->userdata('cms_website_name');?> Teams
    </p>
  </div>
</div>-