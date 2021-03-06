<?php
/**
 * @copyright   Copyright (C) 2010-2020 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Application\UI\Links\Indirect\BlockObjectPickerDialog;


use Combodo\iTop\Application\UI\Base\Component\Button\ButtonFactory;
use Combodo\iTop\Application\UI\Base\Component\Form\Form;
use Combodo\iTop\Application\UI\Base\Component\Input\InputFactory;
use Combodo\iTop\Application\UI\Base\Component\Toolbar\Toolbar;
use Combodo\iTop\Application\UI\Base\Layout\UIContentBlock;
use Dict;

/**
 * Class BlockObjectPickerDialog
 *
 * @package Combodo\iTop\Application\UI\Links\Indirect\BlockObjectPickerDialog
 */
class BlockObjectPickerDialog extends UIContentBlock
{
	// Overloaded constants
	public const BLOCK_CODE = 'ibo-block-object-picker-dialog';
	public const DEFAULT_JS_ON_READY_TEMPLATE_REL_PATH = 'application/links/indirect/block-object-picker-dialog/layout';

	public $sLinkedSetId;
	public $iInputId;
	public $sLinkedClassName;
	public $sClassName;

	public function AddForm()
	{
		$sEmptyList = Dict::S('UI:Message:EmptyList:UseSearchForm');
		$sCancel = Dict::S('UI:Button:Cancel');
		$sAdd = Dict::S('UI:Button:Add');

		$oForm = new Form("ObjectsAddForm_{$this->sLinkedSetId}");
		$this->AddSubBlock($oForm);
		$oBlock = new UIContentBlock("SearchResultsToAdd_{$this->sLinkedSetId}", 'ibo-block-object-picker-dialog--results');
		$oForm->AddSubBlock($oBlock);
		$oBlock->AddHtml("<p>{$sEmptyList}</p>");

		$oForm->AddSubBlock(InputFactory::MakeForHidden("count_{$this->sLinkedSetId}", '0', "count_{$this->sLinkedSetId}"));

		$oToolbar = new Toolbar(null, 'ibo-datatable--selection-validation-buttons-toolbar');
		$this->AddSubBlock($oToolbar);
		$oRemoveButton = ButtonFactory::MakeForSecondaryAction($sCancel, null, null, false);
		$oRemoveButton->SetOnClickJsCode("$('#dlg_{$this->sLinkedSetId}').dialog('close');");
		$oToolbar->AddSubBlock($oRemoveButton);

		$oAddButton = ButtonFactory::MakeForSecondaryAction($sAdd, null, null, false, "btn_ok_{$this->sLinkedSetId}");
		$oAddButton->SetIsDisabled(true)
			->SetOnClickJsCode("return oWidget{$this->iInputId}.DoAddObjects(this.id);");
		$oToolbar->AddSubBlock($oAddButton);
	}
}