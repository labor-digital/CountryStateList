<?php
namespace CountryStateList;

class Countries
{
	
	protected static $_stateList;
	protected static $_countryList;
	protected static $_regionList;
	
	
	public static function getStateList($exclude = []) : ?array
	{
		if(is_null(self::$_stateList))
			self::$_stateList = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.DS.'data'.DIRECTORY_SEPARATOR.'states.json'), true);

		$stateList = self::$_stateList;
		if(!empty($exclude) && is_array($exclude))
		{
			foreach($exclude as $exc)
				if(isset($stateList[$exc]))
					unset($stateList[$exc]);
		}
		return $stateList;
	}
	
	public static function getRegionList($exclude = []) : ?array
	{
		if(is_null(self::$_regionList))
			self::$_regionList = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.DS.'data'.DIRECTORY_SEPARATOR.'regions.json'), true);

		$regionList = self::$_regionList;
		if(!empty($exclude) && is_array($exclude))
		{
			foreach($exclude as $exc)
				if(isset($regionList[$exc]))
					unset($regionList[$exc]);
		}
		return $regionList;
	}
	
	public static function getCountryList($exclude = [], $rename = []) : ?array
	{
		if(is_null(self::$_countryList))
			self::$_countryList = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.DS.'data'.DIRECTORY_SEPARATOR.'countries.json'), true);

		$countryList = self::$_countryList;
		if(!empty($exclude) && is_array($exclude))
		{
			foreach($exclude as $exc)
				if(isset($countryList[$exc]))
					unset($countryList[$exc]);
		}
		if(!empty($rename) && is_array($rename))
		{
			foreach($rename as $ren => $renName)
				if(isset($countryList[$ren]))
					$countryList[$ren] = $renName;
		}
		return $countryList;
	}
	
	public static function getCountryName(string $countryCode) : ?string
	{
		$countries = self::getCountryList();
		if(empty($countries[$countryCode]))
			return null;
		
		return $countries[$countryCode];
	}
	
	public static function getCountryRegion(string $countryCode) : ?string
	{
		$regions = self::getRegionList();
		if(empty($regions[$countryCode]))
			return null;
		
		return $regions[$countryCode];
	}
	
	public static function getCountryStates(string $countryCode) : ?array
	{
		$states = self::getStateList();
		if(empty($states[$countryCode]))
			return null;
		
		return $states[$countryCode];
	}
	
}