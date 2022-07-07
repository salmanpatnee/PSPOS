<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "country" => "Albania", "currency" => "Leke", "code" => "ALL", "symbol" => "Lek",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "America", "currency" => "Dollars", "code" => "USD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Afghanistan", "currency" => "Afghanis", "code" => "AF", "symbol" => "؋",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Argentina", "currency" => "Pesos", "code" => "ARS", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Aruba", "currency" => "Guilders", "code" => "AWG", "symbol" => "ƒ",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Australia", "currency" => "Dollars", "code" => "AUD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Azerbaijan", "currency" => "New Manats", "code" => "AZ", "symbol" => "ман",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Bahamas", "currency" => "Dollars", "code" => "BSD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Barbados", "currency" => "Dollars", "code" => "BBD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Belarus", "currency" => "Rubles", "code" => "BYR", "symbol" => "p.",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Belgium", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Beliz", "currency" => "Dollars", "code" => "BZD", "symbol" => "BZ$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Bermuda", "currency" => "Dollars", "code" => "BMD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Bolivia", "currency" => "Bolivianos", "code" => "BOB", "symbol" => '$b',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Bosnia and Herzegovina", "currency" => "Convertible Marka", "code" => "BAM", "symbol" => "KM",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Botswana", "currency" => "Pula's", "code" => "BWP", "symbol" => "P",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Bulgaria", "currency" => "Leva", "code" => "BG", "symbol" => "лв",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Brazil", "currency" => "Reais", "code" => "BRL", "symbol" => "R$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Britain [United Kingdom]", "currency" => "Pounds", "code" => "GBP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Brunei Darussalam", "currency" => "Dollars", "code" => "BND", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Cambodia", "currency" => "Riels", "code" => "KHR", "symbol" => "៛",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Canada", "currency" => "Dollars", "code" => "CAD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Cayman Islands", "currency" => "Dollars", "code" => "KYD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Chile", "currency" => "Pesos", "code" => "CLP", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "China", "currency" => "Yuan Renminbi", "code" => "CNY", "symbol" => "¥",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Colombia", "currency" => "Pesos", "code" => "COP", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Costa Rica", "currency" => "Colón", "code" => "CRC", "symbol" => "₡",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Croatia", "currency" => "Kuna", "code" => "HRK", "symbol" => "kn",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Cuba", "currency" => "Pesos", "code" => "CUP", "symbol" => "₱",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Cyprus", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Czech Republic", "currency" => "Koruny", "code" => "CZK", "symbol" => "Kč",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Denmark", "currency" => "Kroner", "code" => "DKK", "symbol" => "kr",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Dominican Republic", "currency" => "Pesos", "code" => "DOP ", "symbol" => "RD$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "East Caribbean", "currency" => "Dollars", "code" => "XCD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Egypt", "currency" => "Pounds", "code" => "EGP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "El Salvador", "currency" => "Colones", "code" => "SVC", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "England [United Kingdom]", "currency" => "Pounds", "code" => "GBP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Euro", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Falkland Islands", "currency" => "Pounds", "code" => "FKP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Fiji", "currency" => "Dollars", "code" => "FJD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "France", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Ghana", "currency" => "Cedis", "code" => "GHS", "symbol" => "¢",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Gibraltar", "currency" => "Pounds", "code" => "GIP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Greece", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Guatemala", "currency" => "Quetzales", "code" => "GTQ", "symbol" => "Q",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Guernsey", "currency" => "Pounds", "code" => "GGP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Guyana", "currency" => "Dollars", "code" => "GYD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Holland [Netherlands]", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Honduras", "currency" => "Lempiras", "code" => "HNL", "symbol" => "L",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Hong Kong", "currency" => "Dollars", "code" => "HKD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Hungary", "currency" => "Forint", "code" => "HUF", "symbol" => "Ft",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Iceland", "currency" => "Kronur", "code" => "ISK", "symbol" => "kr",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "India", "currency" => "Rupees", "code" => "INR", "symbol" => "₹",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Indonesia", "currency" => "Rupiahs", "code" => "IDR", "symbol" => "Rp",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Iran", "currency" => "Rials", "code" => "IRR", "symbol" => "﷼",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Ireland", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Isle of Man", "currency" => "Pounds", "code" => "IMP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Israel", "currency" => "New Shekels", "code" => "ILS", "symbol" => "₪",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Italy", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Jamaica", "currency" => "Dollars", "code" => "JMD", "symbol" => "J$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Japan", "currency" => "Yen", "code" => "JPY", "symbol" => "¥",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Jersey", "currency" => "Pounds", "code" => "JEP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Kazakhstan", "currency" => "Tenge", "code" => "KZT", "symbol" => "лв",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Korea [North]", "currency" => "Won", "code" => "KPW", "symbol" => "₩",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Korea [South]", "currency" => "Won", "code" => "KRW", "symbol" => "₩",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Kyrgyzstan", "currency" => "Soms", "code" => "KGS", "symbol" => "лв",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Laos", "currency" => "Kips", "code" => "LAK", "symbol" => "₭",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Latvia", "currency" => "Lati", "code" => "LVL", "symbol" => "Ls",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Lebanon", "currency" => "Pounds", "code" => "LBP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Liberia", "currency" => "Dollars", "code" => "LRD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Liechtenstein", "currency" => "Switzerland Francs", "code" => "CHF", "symbol" => "CHF",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Lithuania", "currency" => "Litai", "code" => "LTL", "symbol" => "Lt",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Luxembourg", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Macedonia", "currency" => "Denars", "code" => "MKD", "symbol" => "ден",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Malaysia", "currency" => "Ringgits", "code" => "MYR", "symbol" => "RM",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Malta", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Mauritius", "currency" => "Rupees", "code" => "MUR", "symbol" => "₨",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Mexico", "currency" => "Pesos", "code" => "MXN", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Mongolia", "currency" => "Tugriks", "code" => "MNT", "symbol" => "₮",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Mozambique", "currency" => "Meticais", "code" => "MZ", "symbol" => "MT",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Namibia", "currency" => "Dollars", "code" => "NAD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Nepal", "currency" => "Rupees", "code" => "NPR", "symbol" => "₨",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Netherlands Antilles", "currency" => "Guilders", "code" => "ANG", "symbol" => "ƒ",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Netherlands", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "New Zealand", "currency" => "Dollars", "code" => "NZD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Nicaragua", "currency" => "Cordobas", "code" => "NIO", "symbol" => "C$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Nigeria", "currency" => "Nairas", "code" => "NGN", "symbol" => "₦",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "North Korea", "currency" => "Won", "code" => "KPW", "symbol" => "₩",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Norway", "currency" => "Krone", "code" => "NOK", "symbol" => "kr",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Oman", "currency" => "Rials", "code" => "OMR", "symbol" => "﷼",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Pakistan", "currency" => "Rupees", "code" => "PKR", "symbol" => "₨",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Panama", "currency" => "Balboa", "code" => "PAB", "symbol" => "B/.",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Paraguay", "currency" => "Guarani", "code" => "PYG", "symbol" => "Gs",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Peru", "currency" => "Nuevos Soles", "code" => "PE", "symbol" => "S/.",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Philippines", "currency" => "Pesos", "code" => "PHP", "symbol" => "Php",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Poland", "currency" => "Zlotych", "code" => "PL", "symbol" => "zł",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Qatar", "currency" => "Rials", "code" => "QAR", "symbol" => "﷼",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Romania", "currency" => "New Lei", "code" => "RO", "symbol" => "lei",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Russia", "currency" => "Rubles", "code" => "RUB", "symbol" => "руб",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Saint Helena", "currency" => "Pounds", "code" => "SHP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Saudi Arabia", "currency" => "Riyals", "code" => "SAR", "symbol" => "﷼",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Serbia", "currency" => "Dinars", "code" => "RSD", "symbol" => "Дин.",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Seychelles", "currency" => "Rupees", "code" => "SCR", "symbol" => "₨",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Singapore", "currency" => "Dollars", "code" => "SGD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Slovenia", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Solomon Islands", "currency" => "Dollars", "code" => "SBD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Somalia", "currency" => "Shillings", "code" => "SOS", "symbol" => "S",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "South Africa", "currency" => "Rand", "code" => "ZAR", "symbol" => "R",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "South Korea", "currency" => "Won", "code" => "KRW", "symbol" => "₩",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Spain", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Sri Lanka", "currency" => "Rupees", "code" => "LKR", "symbol" => "₨",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Sweden", "currency" => "Kronor", "code" => "SEK", "symbol" => "kr",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Switzerland", "currency" => "Francs", "code" => "CHF", "symbol" => "CHF",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Suriname", "currency" => "Dollars", "code" => "SRD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Syria", "currency" => "Pounds", "code" => "SYP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Taiwan", "currency" => "New Dollars", "code" => "TWD", "symbol" => "NT$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Thailand", "currency" => "Baht", "code" => "THB", "symbol" => "฿",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Trinidad and Tobago", "currency" => "Dollars", "code" => "TTD", "symbol" => "TT$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Turkey", "currency" => "Lira", "code" => "TRY", "symbol" => "TL",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Turkey", "currency" => "Liras", "code" => "TRL", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Tuvalu", "currency" => "Dollars", "code" => "TVD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Ukraine", "currency" => "Hryvnia", "code" => "UAH", "symbol" => "₴",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "United Kingdom", "currency" => "Pounds", "code" => "GBP", "symbol" => "£",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "United States of America", "currency" => "Dollars", "code" => "USD", "symbol" => '$',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Uruguay", "currency" => "Pesos", "code" => "UYU", "symbol" => '$U',
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Uzbekistan", "currency" => "Sums", "code" => "UZS", "symbol" => "лв",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Vatican City", "currency" => "Euro", "code" => "EUR", "symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Venezuela", "currency" => "Bolivares Fuertes", "code" => "VEF", "symbol" => "Bs",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Vietnam", "currency" => "Dong", "code" => "VND", "symbol" => "₫",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Yemen", "currency" => "Rials", "code" => "YER", "symbol" => "﷼",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Zimbabwe", "currency" => "Zimbabwe Dollars", "code" => "ZWD", "symbol" => "Z$",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Iraq", "currency" => "Iraqi dinar", "code" => "IQD", "symbol" => "د.ع",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            [
                "country" => "Kenya", "currency" => "Kenyan shilling", "code" => "KES", "symbol" => "KSh",
                "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null
            ],
            ["country" => "Bangladesh", "currency" => "Taka", "code" => "BDT", "symbol" => "৳", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Algerie", "currency" => "Algerian dinar", "code" => "DZD", "symbol" => "د.ج", "thousand_separator" => " ", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "United Arab Emirates", "currency" => "United Arab Emirates dirham", "code" => "AED", "symbol" => "د.إ", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Uganda", "currency" => "Uganda shillings", "code" => "UGX", "symbol" => "USh", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Tanzania", "currency" => "Tanzanian shilling", "code" => "TZS", "symbol" => "TSh", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Angola", "currency" => "Kwanza", "code" => "AOA", "symbol" => "Kz", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Kuwait", "currency" => "Kuwaiti dinar", "code" => "KWD", "symbol" => "KD", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null],
            ["country" => "Bahrain", "currency" => "Bahraini dinar", "code" => "BHD", "symbol" => "BD", "thousand_separator" => ",", "decimal_separator" => ".", "created_at" => null, "updated_at" => null]
        ];

        Currency::insert($data);
    }
}
