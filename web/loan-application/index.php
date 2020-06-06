<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arvo&family=Montserrat&display=swap">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="css/loan-application.css">
        <title>Loan Application</title>
    </head>
    <body>
        <section class="d-flex align-items-center min-vh-100">
        <div class="container shadow p-5">
            <h1 class="mb-4">Loan Application</h1>
            <div class="progress mb-4">
                <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="alert-message" class="alert alert-danger hide"></div>
            <form id="loan-application" method="post">

                <fieldset>
                    <h2 class="mb-4">Step 1: Loan Details</h2>
                    <p>Please let us know the type of loan, your desired interest rate, term, and the amount you'd like to borrow.</p>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <!-- <label for="loan_type" class="control-label">Loan Type</label> -->
                                <select class="form-control" id="loan_type" name="loan_type:number">
                                    <option>Please select the loan type</option>
                                    <option value="1">Auto Loan</option>
                                    <option value="2">Credit Card</option>
                                    <option value="3">Personal Loan</option>
                                    <option value="4">RV Loan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <!-- <label for="rate" class="control-label">Interest Rate</label> -->
                                <select class="form-control" id="rate" name="rate:number">
                                    <option>Please select your desired interest rate</option>
                                    <option value="3">3% APR</option>
                                    <option value="4">4% APR</option>
                                    <option value="5">5% APR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <!-- <label for="term">Loan Term</label> -->
                                <select class="form-control" id="term" name="term:number">
                                    <option>Please select your desired loan term</option>
                                    <option value="12">1 year</option>
                                    <option value="24">2 years</option>
                                    <option value="36">3 years</option>
                                    <option value="48">4 years</option>
                                    <option value="52">5 years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-label-group"> <!-- input-group -->
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div> -->
                                <input type="text" class="form-control only-numeric" id="amount" name="amount:number" placeholder="Loan Amount" maxlength="7" pattern="[0-9]">
                                <label for="amount">Loan Amount</label>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="password" class="next btn btn-primary" value="Next" />
                </fieldset>

                <fieldset>
                    <h2>Step 2: Applicant Personal Information</h2>
                    <p>Please provide your personal information requested below. All fields are required.</p>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                <label for="first_name" class="control-label">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                <label for="last_name" class="control-label">Last Name</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control only-numeric" id="account_number" name="account_number:number" placeholder="Account Number" maxlength="7" pattern="\d{7}">
                                <label for="account_number" class="control-label">Account Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="ssn" name="ssn" placeholder="SSN" maxlength="11">
                                <label for="ssn" class="control-label">SSN</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-label-group">                                
                                <input type="text" class="form-control only-numeric" id="gross_monthly_income" name="gross_monthly_income:number" placeholder="Gross Monthly Income" maxlength="7" pattern="[0-9]">
                                <label for="gross_monthly_income" class="control-label">Gross Monthly Income</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col">
                            <div class="form-label-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                <label for="email" class="control-label">Email Address</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-label-group">
                                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone Number" maxlength="12">
                                <label for="phone" class="control-label">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    
                    <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary" value="Next" />
                </fieldset>

                <fieldset>
                    <h2>Step 3: Applicant Address Information</h2>
                    <p>Please provide your address information.</p>
                    <div class="form-label-group">
                        <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street address, P.O. box, company name, c/o">
                        <label for="street_address" class="control-label">Street Address</label>
                    </div>
                    
                    <div class="form-row">
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City">
                                <label for="city" class="control-label">City</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <!-- <label for="state" class="control-label">State</label> -->
                                <select class="form-control" id="state" name="state">
                                    <option>Please select your state</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" maxlength="5">
                                <label for="zip" class="control-label">Zip Code</label>
                            </div>
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
                    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                </fieldset>
            </form>
        </div>
        </section>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="js/jquery.serializejson.js"></script>
        <script src="js/loan-application.js"></script>
    </body>
</html>