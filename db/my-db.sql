CREATE SCHEMA loanapp;

CREATE TABLE loanapp.applicant (
    id SERIAL NOT NULL PRIMARY KEY,
    account_number INT NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    ssn VARCHAR(11) NOT NULL,
    gross_monthly_income INT NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(12)
);

CREATE TABLE loanapp.applicant_address (
    id SERIAL NOT NULL PRIMARY KEY,
    account_number INT NOT NULL REFERENCES loanapp.applicant(account_number),
    street_address VARCHAR(100) NOT NULL,
    street_address_2 VARCHAR(100),
    city VARCHAR(50) NOT NULL,
    state VARCHAR(2) NOT NULL,
    zip VARCHAR(10) NOT NULL
);

CREATE TABLE loanapp.loan_types (
    id SERIAL NOT NULL PRIMARY KEY,
    loan_type VARCHAR(25) NOT NULL
);

CREATE TABLE loanapp.loan (
    id SERIAL NOT NULL PRIMARY KEY,
    loan_type INT NOT NULL REFERENCES loanapp.loan_types(id),
    applicant INT NOT NULL REFERENCES loanapp.applicant(account_number),
    rate INT NOT NULL,
    amount INT NOT NULL,
    term INT,
    status VARCHAR(10) NOT NULL
);

insert into loanapp.loan_types(loan_type) values ('auto');
insert into loanapp.loan_types(loan_type) values ('credit card');
insert into loanapp.loan_types(loan_type) values ('rv');
insert into loanapp.loan_types(loan_type) values ('personal');

insert into loanapp.applicant (account_number, first_name, last_name, ssn, gross_monthly_income, email, phone) values (5001227, 'Lester', 'Testcase', '000-00-0001', 8000, 'lester@testcase.com', '801-778-8386');
insert into loanapp.applicant (account_number, first_name, last_name, ssn, gross_monthly_income, email, phone) values (5001144, 'Jeremiah', 'Testcase', '000-00-0002', 10000, 'jeremiah@test.com', '801-732-0055');

insert into loanapp.applicant_address (account_number, street_address, city, state, zip) values (5001227, '2801 N 1050 E', 'Ogden', 'UT', '84414');
insert into loanapp.applicant_address (account_number, street_address, city, state, zip) values (5001144, '2879 W 3600 N', 'Ogden', 'UT', '84404');

insert into loanapp.loan (loan_type, applicant, rate, amount, term, status) values (1, 5001227, 3.5, 10000, 48, 'pending');
insert into loanapp.loan (loan_type, applicant, rate, amount, term, status) values (3, 5001144, 5, 5000, 36, 'pending');