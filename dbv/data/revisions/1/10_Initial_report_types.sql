-- Shows the type of reports users will subscribe to and be receving

INSERT INTO `report_type` (`id`, `report_name`, `description`) VALUES
(1, 'FCDRR Individual monthly', 'This report is an FCDRR report for facilities sent to  respective partners and county coordinators'),
(2, 'FCDRR Data Extract Monthly', 'This is a monthly FCDRR report sent to CHAI and NASCOP'),
(3, 'Weekly Activity Report', 'This report show all tests < 500cp/ml done in facilities sent to respective partners and county coordinators'),
(4, 'Weekly Activity National Report', 'This report shows all facilities that have uploaded their cd4 tests on the web application sent to NASCOP'),
(5, 'Non Reporting PIMAs', 'This is an SMS alert sent to facilities that have not uploaded their cd4 tests on the web application'),
(6, 'Monthly Activity Report', 'This report is of 2 types. One that shows all tests <500cp/ml done. The other shows all tests done during the month');