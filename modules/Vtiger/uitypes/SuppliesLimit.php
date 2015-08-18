<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Vtiger_SuppliesLimit_UIType extends Vtiger_Base_UIType
{

	/**
	 * Function to get the Template name for the current UI Type object
	 * @return <String> - Template Name
	 */
	public function getTemplateName()
	{
		return 'uitypes/SuppliesLimit.tpl';
	}

	/**
	 * Function to get the Display Value, for the current field type with given DB Insert Value
	 * @param <Object> $value
	 * @return <Object>
	 */
	public function getDisplayValue($value)
	{
		$values = explode(',', $value);
		$limits = $this->getLimits();
		$display = [];

		foreach ($values as $limit) {
			if (isset($limits[$limit])) {
				$display[] = $limits[$limit]['value'] . ' - ' . $limits[$limit]['name'];
			}
		}

		return implode(',', $display);
	}

	public static function getValues($value)
	{
		$values = explode(',', $value);
		$limits = self::getLimits();
		$display = [];

		foreach ($values as $limit) {
			if (isset($limits[$limit])) {
				$display[$limit] = $limits[$limit];
			}
		}

		return $display;
	}
	
	public function getListSearchTemplateName()
	{
		return 'uitypes/SuppliesLimitSearchView.tpl';
	}

	/**
	 * Function to get all the available picklist values for the current field
	 * @return <Array> List of picklist values if the field is of type picklist or multipicklist, null otherwise.
	 */
	public function getLimits()
	{
		$limits = Vtiger_Cache::get('Supplies', 'limits');
		if (!$limits) {
			$db = PearDatabase::getInstance();
			$limits = [];
			$result = $db->pquery('SELECT * FROM a_yf_supplies_limits WHERE status = ?', [1]);
			while ($row = $db->fetch_array($result)) {
				$limits[$row['id']] = $row;
			}
			Vtiger_Cache::set('Supplies', 'limits', $limits);
		}

		return $limits;
	}
}
