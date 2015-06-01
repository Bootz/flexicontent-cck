<?php
foreach($files_data as $file_id => $file_data)
{
	$fieldname_n = $fieldname.'['.$n.']';
	$elementid_n = $elementid.'_'.$n;
	$filename_original = $file_data->filename_original ? $file_data->filename_original : $file_data->filename;
	
	$field->html[] = '
		<div class="nowrap_box inlinefile-file-info-box">
			<label class="label inlinefile-file-info-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_FIELD_FILE_ABOUT_SELECTED_FILE', 'FLEXI_FIELD_FILE_ABOUT_SELECTED_FILE_DESC', 1, 1).'" id="'.$elementid_n.'_file-info-lbl" >
				'.JText::_( 'Selected file' ).'
			</label>
			'.($file_data->published ?
			'  <span class="fcfield_textval inline_style_published inlinefile-file-info-txt" id="a_name'.$n.'">'.$filename_original.'</span> '
				.($file_data->url ? ' ['.$file_data->altname.']' : '') :
			'  <span class="fcfield_textval inline_style_unpublished inlinefile-file-info-txt hasTooltip" title="'.flexicontent_html::getToolTip('FLEXI_FILE_FIELD_FILE_UNPUBLISHED', 'FLEXI_FILE_FIELD_FILE_UNPUBLISHED_DESC', 1, 1).'" style="opacity:0.5; text-style:italic;" id="a_name'.$n.'" [UNPUBLISHED]">'.$filename_original.'</span> '
				.($file_data->url ? ' ['.$file_data->altname.']' : '')
			).'
			
			'.(!$required ? '
			<input type="checkbox" id="'.$elementid_n.'_file-del" class="inlinefile-file-del" name="'.$fieldname_n.'[file-del]" value="1" onclick="file_fcfield_del_existing_value'.$field->id.'(this);" />
			<label class="label inlinefile-file-clear-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_FIELD_FILE_ABOUT_REMOVE_FILE', 'FLEXI_FIELD_FILE_ABOUT_REMOVE_FILE_DESC', 1, 1).'" id="'.$elementid_n.'_file-del-lbl" for="'.$elementid_n.'_file-del" >
				'.JText::_( 'Remove file' ).'
			</label>
			' : ($has_values > $n ? '<div class="alert alert-info fc-small fc-iblock">'.JText::_('FLEXI_FIELD_FILE_REQUIRED_UPLOAD_NEW_TO_REPLACE').'</div>' : '')).'
		</div>
	
		<div class="nowrap_box inlinefile-upload-box">
			<label class="label inlinefile-upload-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_CHOOSE_FILE', 'FLEXI_CHOOSE_FILE_DESC', 1, 1).'" id="'.$elementid_n.'_Filedata-lbl" for="'.$elementid_n.'_Filedata" >
				'.JText::_( 'FLEXI_CHOOSE_FILE' ).'
			</label>
			<span class="inlinefile-file-data">
				<input type="hidden" id="'.$elementid_n.'_file-id" name="'.$fieldname_n.'[file-id]" value="'.$file_id.'" />'.'
				<input type="file" id="'.$elementid_n.'_file-data" name="'.$fieldname_n.'[file-data]" class="'.($has_values ? '' : $required_class).'" onchange="var file_box = jQuery(this).parent().parent().parent(); file_box.find(\'.inlinefile-secure-data\').show(400);  file_box.find(\'.inlinefile-secure-info\').hide(400);" />
			</span>
		</div>'.
	
	( $iform_title ? '
		<div class="nowrap_box inlinefile-title-box">
			<label class="label inlinefile-title-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_FILE_DISPLAY_TITLE', 'FLEXI_FILE_DISPLAY_TITLE_DESC', 1, 1).'" id="'.$elementid_n.'_file-title-lbl" for="'.$elementid_n.'_file-title">
				'.JText::_( 'FLEXI_FILE_DISPLAY_TITLE' ).'
			</label>
			<span class="inlinefile-title-data">
				<input type="text" id="'.$elementid_n.'_file-title" size="44" name="'.$fieldname_n.'[file-title]" value="'.$file_data->altname.'" class="'.$required_class.'" />
			</span>
		</div>' : '').
	
	( $iform_lang ? '
		<div class="nowrap_box inlinefile-lang-box">
			<label class="label inlinefile-lang-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_LANGUAGE', 'FLEXI_FILE_LANGUAGE_DESC', 1, 1).'" id="'.$elementid_n.'_file-lang-lbl" for="'.$elementid_n.'_file-lang">
				'.JText::_( 'FLEXI_LANGUAGE' ).'
			</label>
			<span class="inlinefile-lang-data">
				'.flexicontent_html::buildlanguageslist($fieldname_n.'[file-lang]', 'class="use_select2_lib"', $file_data->language, 1).'
			</span>
		</div>' : '').
	
	( $iform_desc ? '
		<div class="nowrap_box inlinefile-desc-box">
			<label class="label inlinefile-desc-lbl '.$tip_class.'" title="'.flexicontent_html::getToolTip('FLEXI_DESCRIPTION', 'FLEXI_FILE_DESCRIPTION_DESC', 1, 1).'" id="'.$elementid_n.'_file-desc-lbl" for="'.$elementid_n.'_file-desc">
				'.JText::_( 'FLEXI_DESCRIPTION' ).'
			</label>
			<span class="inlinefile-desc-data">
				<textarea id="'.$elementid_n.'_file-desc" cols="24" rows="3" name="'.$fieldname_n.'[file-desc]">'.$file_data->description.'</textarea>
			</span>
		</div>' : '').
	
	( $iform_dir ? '
		<div class="nowrap_box inlinefile-secure-box">
			<label class="label inlinefile-secure-lbl '.$tip_class.'" data-placement="top" title="'.flexicontent_html::getToolTip('FLEXI_CHOOSE_DIRECTORY', 'FLEXI_CHOOSE_DIRECTORY_DESC', 1, 1).'" id="'.$elementid_n.'_secure-lbl">
				'.JText::_( 'FLEXI_TARGET_DIRECTORY' ).'
			</label>
			'.($has_values ? '
			<span class="inlinefile-secure-info">
				<span class="badge badge-info">'.JText::_($file_data->secure ?  'FLEXI_SECURE' : 'FLEXI_MEDIA').'</span>
			</span>' : '').'
			<span class="inlinefile-secure-data" style="'.($has_values ? 'display:none;' : '').'">
				'.flexicontent_html::buildradiochecklist( array(0=> JText::_( 'FLEXI_MEDIA' ), 1=> JText::_( 'FLEXI_SECURE' )) , $fieldname_n.'[secure]', 1, 1, '', $elementid_n.'_secure').'
			</span>
		</div>' : '').
	'
	<div class="fcclear"></div>'
	;
	$n++;
}