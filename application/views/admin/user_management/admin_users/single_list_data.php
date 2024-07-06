<?php if(@$list && @$list_type){?>
    <td>  
        <?php if(@$list->profile_image){?>
            <img src="<?php echo base_url('assets/uploads/customers/'.@$list->profile_image);?>" alt="..." style="width: 30px;height: 30px;object-fit: cover;border-radius: 50%;">
        <?php }else{?>
            <img src="<?php echo base_url('assets/none.png');?>" alt="..." style="width: 30px;height: 30px;object-fit: cover;border-radius: 50%;">
        <?php }?>
    </td>
    <td><?php echo @$list->fullname;?></td>
    <td><?php echo @$list->email;?></td>
    <td><?php echo @$list->username;?></td>
    <td><div class="td-content"><span class="badge badge-primary active_status <?php if(!@$list->admin_status){echo 'd-none';}?>" style="font-size: 10px;padding: 1px 4px">Active</span><span class="badge badge-danger inactive_status <?php if(@$list->admin_status){echo 'd-none';}?>" style="font-size: 10px;padding: 1px 4px">Inactive</span></div></td>
    <td><?php echo date('M d, Y',strtotime(@$list->updated_on));?></td>
    <td>
        <div class="action-dropdown custom-dropdown-icon">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                    <a class="dropdown-item" onclick="callback_form_data('<?php echo @$list->admin_id;?>');" href="javascript:void(0);">Edit</a>
                    <a class="dropdown-item" onclick="callback_confirm_delete_list('Do you want to delete this data?','<?php echo @$list->admin_id;?>')" href="javascript:void(0);">Delete</a>
                    <a class="dropdown-item status_link" onclick="callback_change_list_status('<?php echo @$list->admin_id;?>','<?php echo @$list->admin_status;?>');" href="javascript:void(0);">Change Status</a>
                </div>
            </div>
        </div>
    </td>
<?php }else if(@$list && !@$list_type){?>
    <tr id="list_item_<?php echo @$list->admin_id;?>" ondblclick="callback_form_data('<?php echo @$list->admin_id;?>');">
        <td>  
            <?php if(@$list->profile_image){?>
                <img src="<?php echo base_url('assets/uploads/customers/'.@$list->profile_image);?>" alt="..." style="width: 30px;height: 30px;object-fit: cover;border-radius: 50%;">
            <?php }else{?>
                <img src="<?php echo base_url('assets/none.png');?>" alt="..." style="width: 30px;height: 30px;object-fit: cover;border-radius: 50%;">
            <?php }?>
        </td>
        <td><?php echo @$list->fullname;?></td>
        <td><?php echo @$list->email;?></td>
        <td><?php echo @$list->username;?></td>
        <td><div class="td-content"><span class="badge badge-primary active_status <?php if(!@$list->admin_status){echo 'd-none';}?>" style="font-size: 10px;padding: 1px 4px">Active</span><span class="badge badge-danger inactive_status <?php if(@$list->admin_status){echo 'd-none';}?>" style="font-size: 10px;padding: 1px 4px">Inactive</span></div></td>
        <td><?php echo date('M d, Y',strtotime(@$list->updated_on));?></td>
        <td>
            <div class="action-dropdown custom-dropdown-icon">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                        <a class="dropdown-item" onclick="callback_form_data('<?php echo @$list->admin_id;?>');" href="javascript:void(0);">Edit</a>
                        <a class="dropdown-item" onclick="callback_confirm_delete_list('Do you want to delete this data?','<?php echo @$list->admin_id;?>')" href="javascript:void(0);">Delete</a>
                        <a class="dropdown-item status_link" onclick="callback_change_list_status('<?php echo @$list->admin_id;?>','<?php echo @$list->admin_status;?>');" href="javascript:void(0);">Change Status</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php }?>