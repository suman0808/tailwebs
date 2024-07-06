<?php if(@$list && @$list_type){?>
    <td><?php echo @$list->name;?></td>
    <td><?php echo @$list->subject;?></td>
    <td><?php echo @$list->marks;?></td>
    <td><?php echo date('M d, Y',strtotime(@$list->updated_on));?></td>
    <td>
        <div class="action-dropdown custom-dropdown-icon">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                    <a class="dropdown-item" onclick="callback_form_data('<?php echo @$list->student_id;?>');" href="javascript:void(0);">Edit</a>
                    <a class="dropdown-item" onclick="callback_confirm_delete_list('Do you want to delete this data?','<?php echo @$list->student_id;?>')" href="javascript:void(0);">Delete</a>
                </div>
            </div>
        </div>
    </td>
<?php }else if(@$list && !@$list_type){?>
    <tr id="list_item_<?php echo @$list->student_id;?>" ondblclick="callback_form_data('<?php echo @$list->student_id;?>');">
        <td><?php echo @$list->name;?></td>
        <td><?php echo @$list->subject;?></td>
        <td><?php echo @$list->marks;?></td>
        <td><?php echo date('M d, Y',strtotime(@$list->updated_on));?></td>
        <td>
            <div class="action-dropdown custom-dropdown-icon">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                        <a class="dropdown-item" onclick="callback_form_data('<?php echo @$list->student_id;?>');" href="javascript:void(0);">Edit</a>
                        <a class="dropdown-item" onclick="callback_confirm_delete_list('Do you want to delete this data?','<?php echo @$list->student_id;?>')" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php }?>