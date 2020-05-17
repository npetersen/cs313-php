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