
<?
// Preliminary work
error_reporting(E_ALL);
$start = microtime(true);
require 'app/Mage.php';
ini_set('default_socket_timeout',48000);
$resource = Mage::getModel('core/resource');
$db = $resource->getConnection('core_write');
// This script can update product prices
try {
    $app = Mage::app();
} catch (Exception $e) {
    Mage::printException($e);
}
$i=0;
$clients = $db->fetchAll("SELECT * FROM import_customers");
$codes =     array('AF' => 'Afghanistan',
    'AX' => 'Aland Islands',
    'AL' => 'Albania',
    'DZ' => 'Algeria',
    'AS' => 'American Samoa',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AI' => 'Anguilla',
    'AQ' => 'Antarctica',
    'AG' => 'Antigua and Barbuda',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AW' => 'Aruba',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BS' => 'Bahamas',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BB' => 'Barbados',
    'BY' => 'Belarus',
    'BE' => 'Belgium',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia',
    'BA' => 'Bosnia and Herzegowina',
    'BW' => 'Botswana',
    'BV' => 'Bouvet Island (Bouvetoya)',
    'BR' => 'Brazil',
    'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
    'VG' => 'British Virgin Islands',
    'BN' => 'Brunei Darussalam',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CA' => 'Canada',
    'CV' => 'Cape Verde',
    'KY' => 'Cayman Islands',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CX' => 'Christmas Island',
    'CC' => 'Cocos (Keeling) Islands',
    'CO' => 'Colombia',
    'KM' => 'Comoros the',
    'CD' => 'Congo',
    'CG' => 'Congo the',
    'CK' => 'Cook Islands',
    'CR' => 'Costa Rica',
    'CI' => 'Cote d\'Ivoire',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DK' => 'Denmark',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'GQ' => 'Equatorial Guinea',
    'ER' => 'Eritrea',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FO' => 'Faroe Islands',
    'FK' => 'Falkland Islands (Malvinas)',
    'FJ' => 'Fiji',
    'FI' => 'Finland',
    'FR' => 'France',
    'GF' => 'French Guiana',
    'PF' => 'French Polynesia',
    'TF' => 'French Southern Territories',
    'GA' => 'Gabon',
    'GM' => 'Gambia the',
    'GE' => 'Georgia',
    'DE' => 'Germany',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GR' => 'Greece',
    'GL' => 'Greenland',
    'GD' => 'Grenada',
    'GP' => 'Guadeloupe',
    'GU' => 'Guam',
    'GT' => 'Guatemala',
    'GG' => 'Guernsey',
    'GN' => 'Guinea',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HT' => 'Haiti',
    'HM' => 'Heard Island and McDonald Islands',
    'VA' => 'Holy See (Vatican City State)',
    'HN' => 'Honduras',
    'HK' => 'Hong Kong',
    'HU' => 'Hungary',
    'IS' => 'Iceland',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IR' => 'Iran (Islamic Republic of)',
    'IQ' => 'Iraq',
    'IE' => 'Ireland',
    'IM' => 'Isle of Man',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JE' => 'Jersey',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KI' => 'Kiribati',
    'KP' => 'Korea, Democratic People\'s Republic of',
    'KR' => 'Korea, Republic of',
    'KW' => 'Kuwait',
    'KG' => 'Kyrgyzstan',
    'LA' => 'Lao People\'s Democratic Republic',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LS' => 'Lesotho',
    'LR' => 'Liberia',
    'LY' => 'Libyan Arab Jamahiriya',
    'LI' => 'Liechtenstein',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MO' => 'Macao',
    'MK' => 'Macedonia, The Former Yugoslav Republic of',
    'MG' => 'Madagascar',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MH' => 'Marshall Islands',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'YT' => 'Mayotte',
    'MX' => 'Mexico',
    'FM' => 'Micronesia',
    'MD' => 'Moldova',
    'MC' => 'Monaco',
    'MN' => 'Mongolia',
    'ME' => 'Montenegro',
    'MS' => 'Montserrat',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'MM' => 'Myanmar',
    'NA' => 'Namibia',
    'NR' => 'Nauru',
    'NP' => 'Nepal',
    'AN' => 'Netherlands Antilles',
    'NL' => 'Netherlands',
    'NC' => 'New Caledonia',
    'NZ' => 'New Zealand',
    'NI' => 'Nicaragua',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'NU' => 'Niue',
    'NF' => 'Norfolk Island',
    'MP' => 'Northern Mariana Islands',
    'NO' => 'Norway',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PW' => 'Palau',
    'PS' => 'Palestinian Territory',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PN' => 'Pitcairn Islands',
    'PL' => 'Poland',
    'PT' => 'Portugal, Portuguese Republic',
    'PT' => 'Portugal',
    'PR' => 'Puerto Rico',
    'QA' => 'Qatar',
    'RE' => 'Reunion',
    'RO' => 'Romania',
    'RU' => 'Russian Federation',
    'RW' => 'Rwanda',
    'BL' => 'Saint Barthelemy',
    'SH' => 'Saint Helena',
    'KN' => 'Saint Kitts and Nevis',
    'LC' => 'Saint Lucia',
    'MF' => 'Saint Martin',
    'PM' => 'Saint Pierre and Miquelon',
    'VC' => 'Saint Vincent and the Grenadines',
    'WS' => 'Samoa',
    'SM' => 'San Marino',
    'ST' => 'Sao Tome and Principe',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SC' => 'Seychelles',
    'SL' => 'Sierra Leone',
    'SG' => 'Singapore',
    'SK' => 'Slovakia (Slovak Republic)',
    'SI' => 'Slovenia',
    'SB' => 'Solomon Islands',
    'SO' => 'Somalia, Somali Republic',
    'ZA' => 'South Africa',
    'GS' => 'South Georgia and the South Sandwich Islands',
    'ES' => 'Spain',
    'LK' => 'Sri Lanka',
    'SD' => 'Sudan',
    'SR' => 'Suriname',
    'SJ' => 'Svalbard & Jan Mayen Islands',
    'SZ' => 'Swaziland',
    'SE' => 'Sweden',
    'CH' => 'Switzerland, Swiss Confederation',
    'CH' => 'Switzerland',
    'SY' => 'Syrian Arab Republic',
    'TW' => 'Taiwan',
    'TJ' => 'Tajikistan',
    'TZ' => 'Tanzania, United Republic of',
    'TH' => 'Thailand',
    'TL' => 'East Timor',
    'TG' => 'Togo',
    'TK' => 'Tokelau',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TM' => 'Turkmenistan',
    'TC' => 'Turks and Caicos Islands',
    'TV' => 'Tuvalu',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'GB' => 'United Kingdom',
    'US' => 'United States of America',
    'US' => 'United States',
    'UM' => 'United States Minor Outlying Islands',
    'VI' => 'Virgin Islands (U.S.)',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'ZM' => 'Zambia',
    'VN' => 'Viet Nam',
    'ZW' => 'Zimbabwe',
    'VE' => 'Venezuela',
);
function decode($input) {
    return preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $input); 
}
    
$countries = array_flip($codes);
$countries['France, Metropolitan'] = 'FR';
$countries['Macau'] = 'MO';
foreach($clients as $client) {
    if(!empty($client['Email_address'])) {
        $c = Mage::getModel('customer/customer');
        $c->setWebsiteId(1);
        $customer = $c->loadByEmail($client['Email_address']);
        if($customer->getId()) {
            echo $client['Email_address'] . ' already imported.'."\n";    
            continue;
        }
        $temp = Mage::getModel('customer/customer')->getCollection()->addFieldToFilter('email',$client['Email_address']);
        if(count($temp)===0) {
            if(empty($client['Customer first name']) AND empty($client['Customer surname'])) continue;
            $i++;
            $customer = Mage::getModel('customer/customer');
            
            $password = $customer->generatePassword(8);
            $newCustomer = array(
                'id' => $client['Customers ID'],
                'email' => $client['Email_address'],
                'password_hash' => md5($password).':',
                'store_id' => 1,
                'website_id' => 1,
                'company' => '',
                'firstname' => decode($client['Customer first name']),
                'lastname' => decode($client['Customer surname']),
                'taxvat' => '',
            );
            
            $newCustomer['region'] = getAttributeIndexByValue('region',$client['Region'],false);
            $newCustomer['role'] = getAttributeIndexByValue('role',$client['Role'],false);
            $interested_in = array();
            if($client['Interested in PYP']=='TRUE') {
                $interested_in[] = getAttributeIndexByValue('interested_in','PYP',false);
            }
            if($client['Interested in MYP']=='TRUE') {
                $interested_in[] = getAttributeIndexByValue('interested_in','MYP',false);
            }
            if($client['Interested in DP']=='TRUE') {
                $interested_in[] = getAttributeIndexByValue('interested_in','DP',false);
            }
            if(count($interested_in)>0) {
                $newCustomer['interested_in'] = implode(",",$interested_in);
            }
            
            /*$newCustomer['gender'] = 1;
            if($client['Gender']=='f') {
                $newCustomer['gender'] = 2;
            }*/
            if(!empty($client['Street address']) AND !empty($client['Postcode']) AND !empty($client['City'])) {
                $secondAddressLine = null;
                if(!empty($client['Suburb'])) {
                    $secondAddressLine .= $client['Suburb'];
                }
                if(!empty($client['State'])) {
                    if($secondAddressLine != null) $secondAddressLine .= ', ';
                    $secondAddressLine .= $client['State'];
                }
                $client['addresses'][] = array(
                    'company'       => decode($newCustomer['company']),
                    'firstname'  => decode($newCustomer['firstname']),
                    'lastname'   => decode($newCustomer['lastname']),
                    'country_id' => $countries[$client['Country']], // change from country name to ISO code
                    'city'       => decode($client['City']),
                    'region'     => decode($client['State']),
                    'street'     => array(decode($client['Street address']),decode($secondAddressLine)),
                    'telephone'  => $client['Telephone'],
                    'postcode'   => $client['Postcode'],
                    'is_default_billing'  => true,
                    'is_default_shipping' => true
                );
            }
            try {
                $transaction = Mage::getModel('core/resource_transaction');
                $customer = Mage::getModel('customer/customer');
                $customer->setData($newCustomer);
                echo "Save customer ".$client['Customers ID']."\n";
                $customer = $customer->save();
                file_put_contents("passwords.csv",$customer->getEmail()."\t".$customer->getFirstname()."\t".$customer->getLastname()."\t".$password."\n",FILE_APPEND);
                echo $customer->getFirstname()." ".$customer->getLastname()." is imported.\n";
                if($customer->getId()) {
                    foreach($client['addresses'] as $newCustomerAddress) {
                        echo "Save customer ".$client['Customers ID']." address\n";
                        $customerAddress = Mage::getModel('customer/address');
                        $customerAddress->setData($newCustomerAddress)
                            ->setParentId($customer->getId())
                            ->setCustomerId($customer->getId())
                            ->setIsDefaultBilling('1')
                            ->setIsDefaultShipping('1')
                            ->setSaveInAddressBook('1');
                        $customerAddress->save();
                    }
                
                    if ($client['Customer newsletter'] == 'TRUE'){
                        $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($customer->getEmail());
                        if (!$subscriber->getId() || $subscriber->getStatus() == Mage_Newsletter_Model_Subscriber::STATUS_UNSUBSCRIBED || $subscriber->getStatus() == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
                            echo "Subscribe customer ".$client['client_id']." to newsletter\n";
                            Mage::getModel('newsletter/subscriber')->setImportMode(true)->subscribe($customer->getEmail());
                            $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($customer->getEmail());
                            $subscriber->setStatus(Mage_Newsletter_Model_Subscriber::STATUS_SUBSCRIBED);
                            $subscriber->save();
                        }
                    }
                }
            } catch(Exception $e) {
                echo 'Error; ' . $e->getMessage();
            }
        }
    }
}
echo $i." total";
function getAttributeIndexByValue($attribute_code,$value,$create=true) {
    $attributeId = Mage::getResourceModel('eav/entity_attribute')->getIdByCode('customer',$attribute_code);
    $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($attributeId);
    foreach ( $attribute->getSource()->getAllOptions(true, true) as $option){
        $attributeArray[$option['label']] = $option['value'];
    }
    if(isset($attributeArray[$value])) {
        return $attributeArray[$value];
    } else {
        if($create) {
            return addAttributeValue($attribute_code,$value,true);
        } else {
            return false;
        }
    }
}
