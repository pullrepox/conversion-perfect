<?php


namespace App\Models;


class Utils
{
    public static function timeZones()
    {
        return [
            'America/Adak'              => '(GMT-10:00) America/Adak (HST)',
            'America/Atka'              => '(GMT-10:00) America/Atka (HST)',
            'America/Anchorage'         => '(GMT-9:00) America/Anchorage (AKST)',
            'America/Juneau'            => '(GMT-9:00) America/Juneau (AKST)',
            'America/Nome'              => '(GMT-9:00) America/Nome (AKST)',
            'America/Yakutat'           => '(GMT-9:00) America/Yakutat (AKST)',
            'America/Dawson'            => '(GMT-8:00) America/Dawson (PST)',
            'America/Ensenada'          => '(GMT-8:00) America/Ensenada (PST)',
            'America/Los_Angeles'       => '(GMT-8:00) America/Los_Angeles (PST)',
            'America/Tijuana'           => '(GMT-8:00) America/Tijuana (PST)',
            'America/Vancouver'         => '(GMT-8:00) America/Vancouver (PST)',
            'America/Whitehorse'        => '(GMT-8:00) America/Whitehorse (PST)',
            'Canada/Pacific'            => '(GMT-8:00) Canada/Pacific (PST)',
            'Canada/Yukon'              => '(GMT-8:00) Canada/Yukon (PST)',
            'Mexico/BajaNorte'          => '(GMT-8:00) Mexico/BajaNorte (PST)',
            'America/Boise'             => '(GMT-7:00) America/Boise (MST)',
            'America/Cambridge_Bay'     => '(GMT-7:00) America/Cambridge_Bay (MST)',
            'America/Chihuahua'         => '(GMT-7:00) America/Chihuahua (MST)',
            'America/Dawson_Creek'      => '(GMT-7:00) America/Dawson_Creek (MST)',
            'America/Denver'            => '(GMT-7:00) America/Denver (MST)',
            'America/Edmonton'          => '(GMT-7:00) America/Edmonton (MST)',
            'America/Hermosillo'        => '(GMT-7:00) America/Hermosillo (MST)',
            'America/Inuvik'            => '(GMT-7:00) America/Inuvik (MST)',
            'America/Mazatlan'          => '(GMT-7:00) America/Mazatlan (MST)',
            'America/Phoenix'           => '(GMT-7:00) America/Phoenix (MST)',
            'America/Shiprock'          => '(GMT-7:00) America/Shiprock (MST)',
            'America/Yellowknife'       => '(GMT-7:00) America/Yellowknife (MST)',
            'Canada/Mountain'           => '(GMT-7:00) Canada/Mountain (MST)',
            'Mexico/BajaSur'            => '(GMT-7:00) Mexico/BajaSur (MST)',
            'America/Belize'            => '(GMT-6:00) America/Belize (CST)',
            'America/Cancun'            => '(GMT-6:00) America/Cancun (CST)',
            'America/Chicago'           => '(GMT-6:00) America/Chicago (CST)',
            'America/Costa_Rica'        => '(GMT-6:00) America/Costa_Rica (CST)',
            'America/El_Salvador'       => '(GMT-6:00) America/El_Salvador (CST)',
            'America/Guatemala'         => '(GMT-6:00) America/Guatemala (CST)',
            'America/Knox_IN'           => '(GMT-6:00) America/Knox_IN (CST)',
            'America/Managua'           => '(GMT-6:00) America/Managua (CST)',
            'America/Menominee'         => '(GMT-6:00) America/Menominee (CST)',
            'America/Merida'            => '(GMT-6:00) America/Merida (CST)',
            'America/Mexico_City'       => '(GMT-6:00) America/Mexico_City (CST)',
            'America/Monterrey'         => '(GMT-6:00) America/Monterrey (CST)',
            'America/Rainy_River'       => '(GMT-6:00) America/Rainy_River (CST)',
            'America/Rankin_Inlet'      => '(GMT-6:00) America/Rankin_Inlet (CST)',
            'America/Regina'            => '(GMT-6:00) America/Regina (CST)',
            'America/Swift_Current'     => '(GMT-6:00) America/Swift_Current (CST)',
            'America/Tegucigalpa'       => '(GMT-6:00) America/Tegucigalpa (CST)',
            'America/Winnipeg'          => '(GMT-6:00) America/Winnipeg (CST)',
            'Canada/Central'            => '(GMT-6:00) Canada/Central (CST)',
            'Canada/East-Saskatchewan'  => '(GMT-6:00) Canada/East-Saskatchewan (CST)',
            'Canada/Saskatchewan'       => '(GMT-6:00) Canada/Saskatchewan (CST)',
            'Chile/EasterIsland'        => '(GMT-6:00) Chile/EasterIsland (Easter Is. Time)',
            'Mexico/General'            => '(GMT-6:00) Mexico/General (CST)',
            'America/Atikokan'          => '(GMT-5:00) America/Atikokan (EST)',
            'America/Bogota'            => '(GMT-5:00) America/Bogota (Colombia Time)',
            'America/Cayman'            => '(GMT-5:00) America/Cayman (EST)',
            'America/Coral_Harbour'     => '(GMT-5:00) America/Coral_Harbour (EST)',
            'America/Detroit'           => '(GMT-5:00) America/Detroit (EST)',
            'America/Fort_Wayne'        => '(GMT-5:00) America/Fort_Wayne (EST)',
            'America/Grand_Turk'        => '(GMT-5:00) America/Grand_Turk (EST)',
            'America/Guayaquil'         => '(GMT-5:00) America/Guayaquil (ECT)',
            'America/Havana'            => '(GMT-5:00) America/Havana (CST – Cuba)',
            'America/Indianapolis'      => '(GMT-5:00) America/Indianapolis (EST)',
            'America/Iqaluit'           => '(GMT-5:00) America/Iqaluit (EST)',
            'America/Jamaica'           => '(GMT-5:00) America/Jamaica (EST)',
            'America/Lima'              => '(GMT-5:00) America/Lima (Peru Time)',
            'America/Louisville'        => '(GMT-5:00) America/Louisville (EST)',
            'America/Montreal'          => '(GMT-5:00) America/Montreal (EST)',
            'America/Nassau'            => '(GMT-5:00) America/Nassau (EST)',
            'America/New_York'          => '(GMT-5:00) America/New_York (EST)',
            'America/Nipigon'           => '(GMT-5:00) America/Nipigon (EST)',
            'America/Panama'            => '(GMT-5:00) America/Panama (EST)',
            'America/Pangnirtung'       => '(GMT-5:00) America/Pangnirtung (EST)',
            'America/Port-au-Prince'    => '(GMT-5:00) America/Port-au-Prince (EST)',
            'America/Resolute'          => '(GMT-5:00) America/Resolute (EST)',
            'America/Thunder_Bay'       => '(GMT-5:00) America/Thunder_Bay (EST)',
            'America/Toronto'           => '(GMT-5:00) America/Toronto (EST)',
            'Canada/Eastern'            => '(GMT-5:00) Canada/Eastern (EST)',
            'America/Caracas'           => '(GMT-4:-30) America/Caracas (Venezuela Time)',
            'America/Anguilla'          => '(GMT-4:00) America/Anguilla (AST)',
            'America/Antigua'           => '(GMT-4:00) America/Antigua (AST)',
            'America/Aruba'             => '(GMT-4:00) America/Aruba (AST)',
            'America/Asuncion'          => '(GMT-4:00) America/Asuncion (Paraguay Time)',
            'America/Barbados'          => '(GMT-4:00) America/Barbados (AST)',
            'America/Blanc-Sablon'      => '(GMT-4:00) America/Blanc-Sablon (AST)',
            'America/Boa_Vista'         => '(GMT-4:00) America/Boa_Vista (AMT)',
            'America/Campo_Grande'      => '(GMT-4:00) America/Campo_Grande (AMT)',
            'America/Cuiaba'            => '(GMT-4:00) America/Cuiaba (AMT)',
            'America/Curacao'           => '(GMT-4:00) America/Curacao (AST)',
            'America/Dominica'          => '(GMT-4:00) America/Dominica (AST)',
            'America/Eirunepe'          => '(GMT-4:00) America/Eirunepe (AMT)',
            'America/Glace_Bay'         => '(GMT-4:00) America/Glace_Bay (AST)',
            'America/Goose_Bay'         => '(GMT-4:00) America/Goose_Bay (AST)',
            'America/Grenada'           => '(GMT-4:00) America/Grenada (AST)',
            'America/Guadeloupe'        => '(GMT-4:00) America/Guadeloupe (AST)',
            'America/Guyana'            => '(GMT-4:00) America/Guyana (Guyana Time)',
            'America/Halifax'           => '(GMT-4:00) America/Halifax (AST)',
            'America/La_Paz'            => '(GMT-4:00) America/La_Paz (Bolivia Time)',
            'America/Manaus'            => '(GMT-4:00) America/Manaus (AMT)',
            'America/Marigot'           => '(GMT-4:00) America/Marigot (AST)',
            'America/Martinique'        => '(GMT-4:00) America/Martinique (AST)',
            'America/Moncton'           => '(GMT-4:00) America/Moncton (AST)',
            'America/Montserrat'        => '(GMT-4:00) America/Montserrat (AST)',
            'America/Port_of_Spain'     => '(GMT-4:00) America/Port_of_Spain (AST)',
            'America/Porto_Acre'        => '(GMT-4:00) America/Porto_Acre (AMT)',
            'America/Porto_Velho'       => '(GMT-4:00) America/Porto_Velho (AMT)',
            'America/Puerto_Rico'       => '(GMT-4:00) America/Puerto_Rico (AST)',
            'America/Rio_Branco'        => '(GMT-4:00) America/Rio_Branco (AMT)',
            'America/Santiago'          => '(GMT-4:00) America/Santiago (Chile Time)',
            'America/Santo_Domingo'     => '(GMT-4:00) America/Santo_Domingo (AST)',
            'America/St_Barthelemy'     => '(GMT-4:00) America/St_Barthelemy (AST)',
            'America/St_Kitts'          => '(GMT-4:00) America/St_Kitts (AST)',
            'America/St_Lucia'          => '(GMT-4:00) America/St_Lucia (AST)',
            'America/St_Thomas'         => '(GMT-4:00) America/St_Thomas (AST)',
            'America/St_Vincent'        => '(GMT-4:00) America/St_Vincent (AST)',
            'America/Thule'             => '(GMT-4:00) America/Thule (AST)',
            'America/Tortola'           => '(GMT-4:00) America/Tortola (AST)',
            'America/Virgin'            => '(GMT-4:00) America/Virgin (AST)',
            'Antarctica/Palmer'         => '(GMT-4:00) Antarctica/Palmer (Chile Time)',
            'Atlantic/Bermuda'          => '(GMT-4:00) Atlantic/Bermuda (AST)',
            'Atlantic/Stanley'          => '(GMT-4:00) Atlantic/Stanley (Falkland Is. Time)',
            'Brazil/Acre'               => '(GMT-4:00) Brazil/Acre (AMT)',
            'Brazil/West'               => '(GMT-4:00) Brazil/West (AMT)',
            'Canada/Atlantic'           => '(GMT-4:00) Canada/Atlantic (AST)',
            'Chile/Continental'         => '(GMT-4:00) Chile/Continental (Chile Time)',
            'America/St_Johns'          => '(GMT-3:-30) America/St_Johns (NST)',
            'Canada/Newfoundland'       => '(GMT-3:-30) Canada/Newfoundland (NST)',
            'America/Araguaina'         => '(GMT-3:00) America/Araguaina (BRT)',
            'America/Bahia'             => '(GMT-3:00) America/Bahia (BRT)',
            'America/Belem'             => '(GMT-3:00) America/Belem (BRT)',
            'America/Buenos_Aires'      => '(GMT-3:00) America/Buenos_Aires (Argentine Time)',
            'America/Catamarca'         => '(GMT-3:00) America/Catamarca (Argentine Time)',
            'America/Cayenne'           => '(GMT-3:00) America/Cayenne (French Guiana Time)',
            'America/Cordoba'           => '(GMT-3:00) America/Cordoba (Argentine Time)',
            'America/Fortaleza'         => '(GMT-3:00) America/Fortaleza (BRT)',
            'America/Godthab'           => '(GMT-3:00) America/Godthab (WGT)',
            'America/Jujuy'             => '(GMT-3:00) America/Jujuy (Argentine Time)',
            'America/Maceio'            => '(GMT-3:00) America/Maceio (BRT)',
            'America/Mendoza'           => '(GMT-3:00) America/Mendoza (Argentine Time)',
            'America/Miquelon'          => '(GMT-3:00) America/Miquelon (PMST)',
            'America/Montevideo'        => '(GMT-3:00) America/Montevideo (Uruguay Time)',
            'America/Paramaribo'        => '(GMT-3:00) America/Paramaribo (Suriname Time)',
            'America/Recife'            => '(GMT-3:00) America/Recife (BRT)',
            'America/Rosario'           => '(GMT-3:00) America/Rosario (Argentine Time)',
            'America/Santarem'          => '(GMT-3:00) America/Santarem (BRT)',
            'America/Sao_Paulo'         => '(GMT-3:00) America/Sao_Paulo (BRT)',
            'Antarctica/Rothera'        => '(GMT-3:00) Antarctica/Rothera (ROTT)',
            'Brazil/East'               => '(GMT-3:00) Brazil/East (BRT)',
            'America/Noronha'           => '(GMT-2:00) America/Noronha (FNT)',
            'Atlantic/South_Georgia'    => '(GMT-2:00) Atlantic/South_Georgia (GST)',
            'Brazil/DeNoronha'          => '(GMT-2:00) Brazil/DeNoronha (FNT)',
            'America/Scoresbysund'      => '(GMT-1:00) America/Scoresbysund (EGT)',
            'Atlantic/Azores'           => '(GMT-1:00) Atlantic/Azores (Azores Time)',
            'Atlantic/Cape_Verde'       => '(GMT-1:00) Atlantic/Cape_Verde (CVT)',
            'Africa/Abidjan'            => '(GMT+0:00) Africa/Abidjan (GMT)',
            'Africa/Accra'              => '(GMT+0:00) Africa/Accra (GMT)',
            'Africa/Bamako'             => '(GMT+0:00) Africa/Bamako (GMT)',
            'Africa/Banjul'             => '(GMT+0:00) Africa/Banjul (GMT)',
            'Africa/Bissau'             => '(GMT+0:00) Africa/Bissau (GMT)',
            'Africa/Casablanca'         => '(GMT+0:00) Africa/Casablanca (WET)',
            'Africa/Conakry'            => '(GMT+0:00) Africa/Conakry (GMT)',
            'Africa/Dakar'              => '(GMT+0:00) Africa/Dakar (GMT)',
            'Africa/El_Aaiun'           => '(GMT+0:00) Africa/El_Aaiun (WET)',
            'Africa/Freetown'           => '(GMT+0:00) Africa/Freetown (GMT)',
            'Africa/Lome'               => '(GMT+0:00) Africa/Lome (GMT)',
            'Africa/Monrovia'           => '(GMT+0:00) Africa/Monrovia (GMT)',
            'Africa/Nouakchott'         => '(GMT+0:00) Africa/Nouakchott (GMT)',
            'Africa/Ouagadougou'        => '(GMT+0:00) Africa/Ouagadougou (GMT)',
            'Africa/Sao_Tome'           => '(GMT+0:00) Africa/Sao_Tome (GMT)',
            'Africa/Timbuktu'           => '(GMT+0:00) Africa/Timbuktu (GMT)',
            'America/Danmarkshavn'      => '(GMT+0:00) America/Danmarkshavn (GMT)',
            'Atlantic/Canary'           => '(GMT+0:00) Atlantic/Canary (WET)',
            'Atlantic/Faeroe'           => '(GMT+0:00) Atlantic/Faeroe (WET)',
            'Atlantic/Faroe'            => '(GMT+0:00) Atlantic/Faroe (WET)',
            'Atlantic/Madeira'          => '(GMT+0:00) Atlantic/Madeira (WET)',
            'Atlantic/Reykjavik'        => '(GMT+0:00) Atlantic/Reykjavik (GMT)',
            'Atlantic/St_Helena'        => '(GMT+0:00) Atlantic/St_Helena (GMT)',
            'Europe/Belfast'            => '(GMT+0:00) Europe/Belfast (GMT)',
            'Europe/Dublin'             => '(GMT+0:00) Europe/Dublin (GMT)',
            'Europe/Guernsey'           => '(GMT+0:00) Europe/Guernsey (GMT)',
            'Europe/Isle_of_Man'        => '(GMT+0:00) Europe/Isle_of_Man (GMT)',
            'Europe/Jersey'             => '(GMT+0:00) Europe/Jersey (GMT)',
            'Europe/Lisbon'             => '(GMT+0:00) Europe/Lisbon (WET)',
            'Europe/London'             => '(GMT+0:00) Europe/London (GMT)',
            'Africa/Algiers'            => '(GMT+1:00) Africa/Algiers (CET)',
            'Africa/Bangui'             => '(GMT+1:00) Africa/Bangui (WAT)',
            'Africa/Brazzaville'        => '(GMT+1:00) Africa/Brazzaville (WAT)',
            'Africa/Ceuta'              => '(GMT+1:00) Africa/Ceuta (CET)',
            'Africa/Douala'             => '(GMT+1:00) Africa/Douala (WAT)',
            'Africa/Kinshasa'           => '(GMT+1:00) Africa/Kinshasa (WAT)',
            'Africa/Lagos'              => '(GMT+1:00) Africa/Lagos (WAT)',
            'Africa/Libreville'         => '(GMT+1:00) Africa/Libreville (WAT)',
            'Africa/Luanda'             => '(GMT+1:00) Africa/Luanda (WAT)',
            'Africa/Malabo'             => '(GMT+1:00) Africa/Malabo (WAT)',
            'Africa/Ndjamena'           => '(GMT+1:00) Africa/Ndjamena (WAT)',
            'Africa/Niamey'             => '(GMT+1:00) Africa/Niamey (WAT)',
            'Africa/Porto-Novo'         => '(GMT+1:00) Africa/Porto-Novo (WAT)',
            'Africa/Tunis'              => '(GMT+1:00) Africa/Tunis (CET)',
            'Africa/Windhoek'           => '(GMT+1:00) Africa/Windhoek (WAT)',
            'Arctic/Longyearbyen'       => '(GMT+1:00) Arctic/Longyearbyen (CET)',
            'Atlantic/Jan_Mayen'        => '(GMT+1:00) Atlantic/Jan_Mayen (CET)',
            'Europe/Amsterdam'          => '(GMT+1:00) Europe/Amsterdam (CET)',
            'Europe/Andorra'            => '(GMT+1:00) Europe/Andorra (CET)',
            'Europe/Belgrade'           => '(GMT+1:00) Europe/Belgrade (CET)',
            'Europe/Berlin'             => '(GMT+1:00) Europe/Berlin (CET)',
            'Europe/Bratislava'         => '(GMT+1:00) Europe/Bratislava (CET)',
            'Europe/Brussels'           => '(GMT+1:00) Europe/Brussels (CET)',
            'Europe/Budapest'           => '(GMT+1:00) Europe/Budapest (CET)',
            'Europe/Copenhagen'         => '(GMT+1:00) Europe/Copenhagen (CET)',
            'Europe/Gibraltar'          => '(GMT+1:00) Europe/Gibraltar (CET)',
            'Europe/Ljubljana'          => '(GMT+1:00) Europe/Ljubljana (CET)',
            'Europe/Luxembourg'         => '(GMT+1:00) Europe/Luxembourg (CET)',
            'Europe/Madrid'             => '(GMT+1:00) Europe/Madrid (CET)',
            'Europe/Malta'              => '(GMT+1:00) Europe/Malta (CET)',
            'Europe/Monaco'             => '(GMT+1:00) Europe/Monaco (CET)',
            'Europe/Oslo'               => '(GMT+1:00) Europe/Oslo (CET)',
            'Europe/Paris'              => '(GMT+1:00) Europe/Paris (CET)',
            'Europe/Podgorica'          => '(GMT+1:00) Europe/Podgorica (CET)',
            'Europe/Prague'             => '(GMT+1:00) Europe/Prague (CET)',
            'Europe/Rome'               => '(GMT+1:00) Europe/Rome (CET)',
            'Europe/San_Marino'         => '(GMT+1:00) Europe/San_Marino (CET)',
            'Europe/Sarajevo'           => '(GMT+1:00) Europe/Sarajevo (CET)',
            'Europe/Skopje'             => '(GMT+1:00) Europe/Skopje (CET)',
            'Europe/Stockholm'          => '(GMT+1:00) Europe/Stockholm (CET)',
            'Europe/Tirane'             => '(GMT+1:00) Europe/Tirane (CET)',
            'Europe/Vaduz'              => '(GMT+1:00) Europe/Vaduz (CET)',
            'Europe/Vatican'            => '(GMT+1:00) Europe/Vatican (CET)',
            'Europe/Vienna'             => '(GMT+1:00) Europe/Vienna (CET)',
            'Europe/Warsaw'             => '(GMT+1:00) Europe/Warsaw (CET)',
            'Europe/Zagreb'             => '(GMT+1:00) Europe/Zagreb (CET)',
            'Europe/Zurich'             => '(GMT+1:00) Europe/Zurich (CET)',
            'Africa/Blantyre'           => '(GMT+2:00) Africa/Blantyre (CAT)',
            'Africa/Bujumbura'          => '(GMT+2:00) Africa/Bujumbura (CAT)',
            'Africa/Cairo'              => '(GMT+2:00) Africa/Cairo (EET)',
            'Africa/Gaborone'           => '(GMT+2:00) Africa/Gaborone (CAT)',
            'Africa/Harare'             => '(GMT+2:00) Africa/Harare (CAT)',
            'Africa/Johannesburg'       => '(GMT+2:00) Africa/Johannesburg (SAST)',
            'Africa/Kigali'             => '(GMT+2:00) Africa/Kigali (CAT)',
            'Africa/Lubumbashi'         => '(GMT+2:00) Africa/Lubumbashi (CAT)',
            'Africa/Lusaka'             => '(GMT+2:00) Africa/Lusaka (CAT)',
            'Africa/Maputo'             => '(GMT+2:00) Africa/Maputo (CAT)',
            'Africa/Maseru'             => '(GMT+2:00) Africa/Maseru (SAST)',
            'Africa/Mbabane'            => '(GMT+2:00) Africa/Mbabane (SAST)',
            'Africa/Tripoli'            => '(GMT+2:00) Africa/Tripoli (EET)',
            'Asia/Amman'                => '(GMT+2:00) Asia/Amman (EET)',
            'Asia/Beirut'               => '(GMT+2:00) Asia/Beirut (EET)',
            'Asia/Damascus'             => '(GMT+2:00) Asia/Damascus (EET)',
            'Asia/Gaza'                 => '(GMT+2:00) Asia/Gaza (EET)',
            'Asia/Istanbul'             => '(GMT+2:00) Asia/Istanbul (EET)',
            'Asia/Jerusalem'            => '(GMT+2:00) Asia/Jerusalem (IST)',
            'Asia/Nicosia'              => '(GMT+2:00) Asia/Nicosia (EET)',
            'Asia/Tel_Aviv'             => '(GMT+2:00) Asia/Tel_Aviv (IST)',
            'Europe/Athens'             => '(GMT+2:00) Europe/Athens (EET)',
            'Europe/Bucharest'          => '(GMT+2:00) Europe/Bucharest (EET)',
            'Europe/Chisinau'           => '(GMT+2:00) Europe/Chisinau (EET)',
            'Europe/Helsinki'           => '(GMT+2:00) Europe/Helsinki (EET)',
            'Europe/Istanbul'           => '(GMT+2:00) Europe/Istanbul (EET)',
            'Europe/Kaliningrad'        => '(GMT+2:00) Europe/Kaliningrad (EET)',
            'Europe/Kiev'               => '(GMT+2:00) Europe/Kiev (EET)',
            'Europe/Mariehamn'          => '(GMT+2:00) Europe/Mariehamn (EET)',
            'Europe/Minsk'              => '(GMT+2:00) Europe/Minsk (EET)',
            'Europe/Nicosia'            => '(GMT+2:00) Europe/Nicosia (EET)',
            'Europe/Riga'               => '(GMT+2:00) Europe/Riga (EET)',
            'Europe/Simferopol'         => '(GMT+2:00) Europe/Simferopol (EET)',
            'Europe/Sofia'              => '(GMT+2:00) Europe/Sofia (EET)',
            'Europe/Tallinn'            => '(GMT+2:00) Europe/Tallinn (EET)',
            'Europe/Tiraspol'           => '(GMT+2:00) Europe/Tiraspol (EET)',
            'Europe/Uzhgorod'           => '(GMT+2:00) Europe/Uzhgorod (EET)',
            'Europe/Vilnius'            => '(GMT+2:00) Europe/Vilnius (EET)',
            'Europe/Zaporozhye'         => '(GMT+2:00) Europe/Zaporozhye (EET)',
            'Africa/Addis_Ababa'        => '(GMT+3:00) Africa/Addis_Ababa (EAT)',
            'Africa/Asmara'             => '(GMT+3:00) Africa/Asmara (EAT)',
            'Africa/Asmera'             => '(GMT+3:00) Africa/Asmera (EAT)',
            'Africa/Dar_es_Salaam'      => '(GMT+3:00) Africa/Dar_es_Salaam (EAT)',
            'Africa/Djibouti'           => '(GMT+3:00) Africa/Djibouti (EAT)',
            'Africa/Kampala'            => '(GMT+3:00) Africa/Kampala (EAT)',
            'Africa/Khartoum'           => '(GMT+3:00) Africa/Khartoum (EAT)',
            'Africa/Mogadishu'          => '(GMT+3:00) Africa/Mogadishu (EAT)',
            'Africa/Nairobi'            => '(GMT+3:00) Africa/Nairobi (EAT)',
            'Antarctica/Syowa'          => '(GMT+3:00) Antarctica/Syowa (SYOT)',
            'Asia/Aden'                 => '(GMT+3:00) Asia/Aden (AST)',
            'Asia/Baghdad'              => '(GMT+3:00) Asia/Baghdad (AST)',
            'Asia/Bahrain'              => '(GMT+3:00) Asia/Bahrain (AST)',
            'Asia/Kuwait'               => '(GMT+3:00) Asia/Kuwait (AST)',
            'Asia/Qatar'                => '(GMT+3:00) Asia/Qatar (AST)',
            'Europe/Moscow'             => '(GMT+3:00) Europe/Moscow (MSK)',
            'Europe/Volgograd'          => '(GMT+3:00) Europe/Volgograd (Volgograd Time)',
            'Indian/Antananarivo'       => '(GMT+3:00) Indian/Antananarivo (EAT)',
            'Indian/Comoro'             => '(GMT+3:00) Indian/Comoro (EAT)',
            'Indian/Mayotte'            => '(GMT+3:00) Indian/Mayotte (EAT)',
            'Asia/Tehran'               => '(GMT+3:30) Asia/Tehran (IRST)',
            'Asia/Baku'                 => '(GMT+4:00) Asia/Baku (AZT)',
            'Asia/Dubai'                => '(GMT+4:00) Asia/Dubai (GST)',
            'Asia/Muscat'               => '(GMT+4:00) Asia/Muscat (GST)',
            'Asia/Tbilisi'              => '(GMT+4:00) Asia/Tbilisi (Georgia Time)',
            'Asia/Yerevan'              => '(GMT+4:00) Asia/Yerevan (AMT)',
            'Europe/Samara'             => '(GMT+4:00) Europe/Samara (Samara Time)',
            'Indian/Mahe'               => '(GMT+4:00) Indian/Mahe (Seychelles Time)',
            'Indian/Mauritius'          => '(GMT+4:00) Indian/Mauritius (Mauritius Time)',
            'Indian/Reunion'            => '(GMT+4:00) Indian/Reunion (Reunion Time)',
            'Asia/Kabul'                => '(GMT+4:30) Asia/Kabul (Afghanistan Time)',
            'Asia/Aqtau'                => '(GMT+5:00) Asia/Aqtau (Aktau Time)',
            'Asia/Aqtobe'               => '(GMT+5:00) Asia/Aqtobe (Aktobe Time)',
            'Asia/Ashgabat'             => '(GMT+5:00) Asia/Ashgabat (Turkmenistan Time)',
            'Asia/Ashkhabad'            => '(GMT+5:00) Asia/Ashkhabad (Turkmenistan Time)',
            'Asia/Dushanbe'             => '(GMT+5:00) Asia/Dushanbe (Tajikistan Time)',
            'Asia/Karachi'              => '(GMT+5:00) Asia/Karachi (Pakistan Time)',
            'Asia/Oral'                 => '(GMT+5:00) Asia/Oral (ORAT)',
            'Asia/Samarkand'            => '(GMT+5:00) Asia/Samarkand (Uzbekistan Time)',
            'Asia/Tashkent'             => '(GMT+5:00) Asia/Tashkent (Uzbekistan Time)',
            'Asia/Yekaterinburg'        => '(GMT+5:00) Asia/Yekaterinburg (YEKT)',
            'Indian/Kerguelen'          => '(GMT+5:00) Indian/Kerguelen (French Southern & Antarctic Lands Time)',
            'Indian/Maldives'           => '(GMT+5:00) Indian/Maldives (Maldives Time)',
            'Asia/Calcutta'             => '(GMT+5:30) Asia/Calcutta (IST)',
            'Asia/Colombo'              => '(GMT+5:30) Asia/Colombo (IST)',
            'Asia/Kolkata'              => '(GMT+5:30) Asia/Kolkata (IST)',
            'Asia/Katmandu'             => '(GMT+5:45) Asia/Katmandu (NPT)',
            'Antarctica/Mawson'         => '(GMT+6:00) Antarctica/Mawson (MAWT)',
            'Antarctica/Vostok'         => '(GMT+6:00) Antarctica/Vostok (VOST)',
            'Asia/Almaty'               => '(GMT+6:00) Asia/Almaty (ALMT)',
            'Asia/Bishkek'              => '(GMT+6:00) Asia/Bishkek (Kyrgyzstan Time)',
            'Asia/Dacca'                => '(GMT+6:00) Asia/Dacca (Bangladesh Time)',
            'Asia/Dhaka'                => '(GMT+6:00) Asia/Dhaka (Bangladesh Time)',
            'Asia/Novosibirsk'          => '(GMT+6:00) Asia/Novosibirsk (NOVT)',
            'Asia/Omsk'                 => '(GMT+6:00) Asia/Omsk (Omsk Time)',
            'Asia/Qyzylorda'            => '(GMT+6:00) Asia/Qyzylorda (QYZT)',
            'Asia/Thimbu'               => '(GMT+6:00) Asia/Thimbu (Bhutan Time)',
            'Asia/Thimphu'              => '(GMT+6:00) Asia/Thimphu (Bhutan Time)',
            'Indian/Chagos'             => '(GMT+6:00) Indian/Chagos (Indian Ocean Territory Time)',
            'Asia/Rangoon'              => '(GMT+6:30) Asia/Rangoon (Myanmar Time)',
            'Indian/Cocos'              => '(GMT+6:30) Indian/Cocos (Cocos Islands Time)',
            'Antarctica/Davis'          => '(GMT+7:00) Antarctica/Davis (DAVT)',
            'Asia/Bangkok'              => '(GMT+7:00) Asia/Bangkok (ICT)',
            'Asia/Ho_Chi_Minh'          => '(GMT+7:00) Asia/Ho_Chi_Minh (ICT)',
            'Asia/Hovd'                 => '(GMT+7:00) Asia/Hovd (HOVT)',
            'Asia/Jakarta'              => '(GMT+7:00) Asia/Jakarta (WIB)',
            'Asia/Krasnoyarsk'          => '(GMT+7:00) Asia/Krasnoyarsk (KRAT)',
            'Asia/Phnom_Penh'           => '(GMT+7:00) Asia/Phnom_Penh (ICT)',
            'Asia/Pontianak'            => '(GMT+7:00) Asia/Pontianak (WIB)',
            'Asia/Saigon'               => '(GMT+7:00) Asia/Saigon (ICT)',
            'Asia/Vientiane'            => '(GMT+7:00) Asia/Vientiane (ICT)',
            'Indian/Christmas'          => '(GMT+7:00) Indian/Christmas (Christmas Island Time)',
            'Antarctica/Casey'          => '(GMT+8:00) Antarctica/Casey (AWST)',
            'Asia/Brunei'               => '(GMT+8:00) Asia/Brunei (Brunei Time)',
            'Asia/Choibalsan'           => '(GMT+8:00) Asia/Choibalsan (CHOT)',
            'Asia/Chongqing'            => '(GMT+8:00) Asia/Chongqing (CST)',
            'Asia/Chungking'            => '(GMT+8:00) Asia/Chungking (CST)',
            'Asia/Harbin'               => '(GMT+8:00) Asia/Harbin (CST)',
            'Asia/Hong_Kong'            => '(GMT+8:00) Asia/Hong_Kong (HKT)',
            'Asia/Irkutsk'              => '(GMT+8:00) Asia/Irkutsk (IRKT)',
            'Asia/Kashgar'              => '(GMT+8:00) Asia/Kashgar (CST)',
            'Asia/Kuala_Lumpur'         => '(GMT+8:00) Asia/Kuala_Lumpur (Malaysia Time)',
            'Asia/Kuching'              => '(GMT+8:00) Asia/Kuching (Malaysia Time)',
            'Asia/Macao'                => '(GMT+8:00) Asia/Macao (CST)',
            'Asia/Macau'                => '(GMT+8:00) Asia/Macau (CST)',
            'Asia/Makassar'             => '(GMT+8:00) Asia/Makassar (WITA)',
            'Asia/Manila'               => '(GMT+8:00) Asia/Manila (Philippines Time)',
            'Asia/Shanghai'             => '(GMT+8:00) Asia/Shanghai (CST)',
            'Asia/Singapore'            => '(GMT+8:00) Asia/Singapore (Singapore Time)',
            'Asia/Taipei'               => '(GMT+8:00) Asia/Taipei (CST)',
            'Asia/Ujung_Pandang'        => '(GMT+8:00) Asia/Ujung_Pandang (WITA)',
            'Asia/Ulaanbaatar'          => '(GMT+8:00) Asia/Ulaanbaatar (ULAT)',
            'Asia/Ulan_Bator'           => '(GMT+8:00) Asia/Ulan_Bator (ULAT)',
            'Asia/Urumqi'               => '(GMT+8:00) Asia/Urumqi (CST)',
            'Australia/Perth'           => '(GMT+8:00) Australia/Perth (AWST)',
            'Australia/West'            => '(GMT+8:00) Australia/West (AWST)',
            'Australia/Eucla'           => '(GMT+8:45) Australia/Eucla (ACWST)',
            'Asia/Dili'                 => '(GMT+9:00) Asia/Dili (Timor-Leste Time)',
            'Asia/Jayapura'             => '(GMT+9:00) Asia/Jayapura (WIT)',
            'Asia/Pyongyang'            => '(GMT+9:00) Asia/Pyongyang (KST)',
            'Asia/Seoul'                => '(GMT+9:00) Asia/Seoul (KST)',
            'Asia/Tokyo'                => '(GMT+9:00) Asia/Tokyo (JST)',
            'Asia/Yakutsk'              => '(GMT+9:00) Asia/Yakutsk (Yakutsk Time)',
            'Australia/Adelaide'        => '(GMT+9:30) Australia/Adelaide (ACST)',
            'Australia/Broken_Hill'     => '(GMT+9:30) Australia/Broken_Hill (ACST)',
            'Australia/Darwin'          => '(GMT+9:30) Australia/Darwin (ACST)',
            'Australia/North'           => '(GMT+9:30) Australia/North (ACST)',
            'Australia/South'           => '(GMT+9:30) Australia/South (ACST)',
            'Australia/Yancowinna'      => '(GMT+9:30) Australia/Yancowinna (ACST)',
            'Antarctica/DumontDUrville' => '(GMT+10:00) Antarctica/DumontDUrville (DDUT)',
            'Asia/Sakhalin'             => '(GMT+10:00) Asia/Sakhalin (Sakhalin Time)',
            'Asia/Vladivostok'          => '(GMT+10:00) Asia/Vladivostok (Vladivostok)',
            'Australia/ACT'             => '(GMT+10:00) Australia/ACT (AET)',
            'Australia/Brisbane'        => '(GMT+10:00) Australia/Brisbane (AET)',
            'Australia/Canberra'        => '(GMT+10:00) Australia/Canberra (AET)',
            'Australia/Currie'          => '(GMT+10:00) Australia/Currie (AET)',
            'Australia/Hobart'          => '(GMT+10:00) Australia/Hobart (AET)',
            'Australia/Lindeman'        => '(GMT+10:00) Australia/Lindeman (AET)',
            'Australia/Melbourne'       => '(GMT+10:00) Australia/Melbourne (AET)',
            'Australia/NSW'             => '(GMT+10:00) Australia/NSW (AET)',
            'Australia/Queensland'      => '(GMT+10:00) Australia/Queensland (AET)',
            'Australia/Sydney'          => '(GMT+10:00) Australia/Sydney (AET)',
            'Australia/Tasmania'        => '(GMT+10:00) Australia/Tasmania (AET)',
            'Australia/Victoria'        => '(GMT+10:00) Australia/Victoria (AET)',
            'Australia/LHI'             => '(GMT+10:30) Australia/LHI (LHST)',
            'Australia/Lord_Howe'       => '(GMT+10:30) Australia/Lord_Howe (LHST)',
            'Asia/Magadan'              => '(GMT+11:00) Asia/Magadan (MAGT)',
            'Antarctica/McMurdo'        => '(GMT+12:00) Antarctica/McMurdo (NZST)',
            'Antarctica/South_Pole'     => '(GMT+12:00) Antarctica/South_Pole (NZST)',
            'Asia/Anadyr'               => '(GMT+12:00) Asia/Anadyr (ANAT)',
            'Asia/Kamchatka'            => '(GMT+12:00) Asia/Kamchatka (PETT)'
        ];
    }
}
