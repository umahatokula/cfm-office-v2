<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ChartOfAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('chart_of_accounts')->truncate();

    	DB::statement("INSERT INTO `chart_of_accounts` (`id`, `name`, `code`, `chart_of_account_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Assets', '1000', NULL, 'header', 1, NULL, NULL),
        (2, 'Current Assets', '1100', 1, 'header', 1, NULL, NULL),
        (3, 'Savings Account', '1110', 2, 'detail', 1, NULL, NULL),
        (4, 'Investment Account', '1120', 2, 'detail', 1, NULL, NULL),
        (5, 'Prepaid Expenses', '1130', 2, 'detail', 1, NULL, NULL),
        (6, 'Account Receivable', '1140', 2, 'detail', 1, NULL, NULL),
        (7, 'Fixed Assets', '1200', 1, 'header', 1, NULL, NULL),
        (8, 'Land ', '1210', 7, 'detail', 1, NULL, NULL),
        (9, 'Building', '1220', 7, 'detail', 1, NULL, NULL),
        (10, 'Furniture & Fittings', '1230', 7, 'detail', 1, NULL, NULL),
        (11, 'Liabilities', '2000', NULL, 'header', 1, NULL, NULL),
        (12, 'Current Liabilities', '2100', 11, 'header', 1, NULL, NULL),
        (13, 'Accounts Payable', '2110', 12, 'detail', 1, NULL, NULL),
        (14, 'Loan payable within a year', '2120', 12, 'detail', 1, NULL, NULL),
        (15, 'Long term Liabilities', '2200', 11, 'header', 1, NULL, NULL),
        (16, 'Loan payable after one year', '2210', 15, 'detail', 1, NULL, NULL),
        (17, 'Fund Balances', '3000', NULL, 'header', 1, NULL, NULL),
        (18, 'Restricted Fund Balances', '3100', 17, 'header', 1, NULL, NULL),
        (19, 'Capital Development', '3101', 18, 'detail', 1, NULL, NULL),
        (20, 'Partnership Accounts', '3102', 18, 'detail', 1, NULL, NULL),
        (21, 'Contributions from One-off Pledges', '3103', 18, 'detail', 1, NULL, NULL),
        (22, 'Building Fund ', '3104', 18, 'detail', 1, NULL, NULL),
        (23, 'Other designated Funds', '3105', 18, 'detail', 1, NULL, NULL),
        (24, 'Unrestricted Funds', '3200', 17, 'header', 1, NULL, NULL),
        (25, 'General Operating Fund', '3201', 24, 'detail', 1, NULL, NULL),
        (26, 'Others', '3202', 24, 'detail', 1, NULL, NULL),
        (27, 'Income', '4000', NULL, 'header', 1, NULL, NULL),
        (28, 'Benevolent Fund', '4100', 27, 'header', 1, NULL, NULL),
        (29, 'Global Mission', '4101', 28, 'detail', 1, NULL, NULL),
        (30, 'Church Development', '4102', 28, 'detail', 1, NULL, NULL),
        (31, 'General Offering', '4103', 28, 'detail', 1, NULL, NULL),
        (32, 'Tithes', '4104', 28, 'detail', 1, NULL, NULL),
        (33, 'Covenant seed', '4105', 28, 'detail', 1, NULL, NULL),
        (34, 'Thanksgiving offering', '4106', 28, 'detail', 1, NULL, NULL),
        (35, 'Expenses', '5000', NULL, 'header', 1, NULL, NULL),
        (36, 'Management', '5100', 35, 'header', 1, NULL, NULL),
        (37, 'Pastoral Staff Salaries/Wages & Housing Allowances', '5101', 36, 'detail', 1, NULL, NULL),
        (38, 'Pension Expenses', '5102', 36, 'detail', 1, NULL, NULL),
        (39, 'Benefits Expense', '5103', 36, 'detail', 1, NULL, NULL),
        (40, 'Travel Expense', '5104', 36, 'detail', 1, NULL, NULL),
        (41, 'Administration', '5200', 35, 'header', 1, NULL, NULL),
        (42, 'Bank Charges', '5201', 41, 'detail', 1, NULL, NULL),
        (43, 'Payroll charges', '5202', 41, 'detail', 1, NULL, NULL),
        (44, 'Office Expenses', '5203', 41, 'detail', 1, NULL, NULL),
        (45, 'General Conference expense', '5204', 41, 'detail', 1, NULL, NULL),
        (46, 'Printing and Stationery', '5205', 41, 'detail', 1, NULL, NULL),
        (47, 'Electricity bills', '5206', 41, 'detail', 1, NULL, NULL),
        (48, 'Rent', '5207', 41, 'detail', 1, NULL, NULL),
        (49, 'Logistics', '5300', 35, 'header', 1, NULL, NULL),
        (50, 'Postage ', '5301', 49, 'detail', 1, NULL, NULL),
        (51, 'Dues, subscription and Resources', '5302', 49, 'detail', 1, NULL, NULL),
        (52, 'Media and Graphics', '5303', 49, 'detail', 1, NULL, NULL),
        (53, 'Airtime ', '5304', 49, 'detail', 1, NULL, NULL),
        (54, 'Internet', '5305', 49, 'detail', 1, NULL, NULL),
        (55, 'Fixed Asset depreciation charge', '5400', 35, 'header', 1, NULL, NULL),
        (56, 'Nuture Ministries', '5500', 35, 'header', 1, NULL, NULL),
        (57, 'Children\'s Ministry', '5501', 56, 'detail', 1, NULL, NULL),
        (58, 'Youth Ministry', '5502', 56, 'detail', 1, NULL, NULL),
        (59, 'Adult/ Aged Ministry', '5503', 56, 'detail', 1, NULL, NULL),
        (60, 'Ministry Expenses', '5600', 35, 'header', 1, NULL, NULL),
        (61, 'Special Music/Special Speakers', '5601', 60, 'detail', 1, NULL, NULL),
        (62, 'Worship & Music supplies', '5602', 60, 'detail', 1, NULL, NULL),
        (63, 'Care of Persons', '5603', 60, 'detail', 1, NULL, NULL),
        (64, 'Pastoral Staff Education. Books', '5604', 60, 'detail', 1, NULL, NULL),
        (65, 'Network& Ministers Conference Expense ', '5605', 60, 'detail', 1, NULL, NULL),
        (66, 'Evangelism', '5606', 60, 'detail', 1, NULL, NULL),
        (67, 'Giving Streams', '5700', 35, 'header', 1, NULL, NULL),
        (68, 'Global Missions', '5701', 67, 'detail', 1, NULL, NULL),
        (69, 'Church Development', '5702', 67, 'detail', 1, NULL, NULL),
        (70, 'Leadership development', '5703', 67, 'detail', 1, NULL, NULL),
        (71, 'Community Relief, development & outreach', '5704', 67, 'detail', 1, NULL, NULL),
        (72, 'Building, Vehicle & Equipment maintenance', '5800', 35, 'header', 1, NULL, NULL),
        (73, 'Equipment maintenance', '5801', 72, 'detail', 1, NULL, NULL),
        (74, 'Repairs and maintenance of vehicles', '5802', 72, 'detail', 1, NULL, NULL),
        (75, 'Repairs and maintenance of building', '5803', 72, 'detail', 1, NULL, NULL),
        (76, 'Small office equipment purchases (non-capital in nature)', '5804', 72, 'detail', 1, NULL, NULL)");
	}
}
