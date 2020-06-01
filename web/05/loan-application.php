<form method="post">
    <input type="hidden" name="action" value="submitLoan">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="first_name" class="control-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="account_number" class="control-label">Account Number</label>
                <input type="number" class="form-control" id="account_number" name="account_number" placeholder="Account Number" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="ssn" class="control-label">SSN</label>
                <input type="text" class="form-control" id="ssn" name="ssn" placeholder="SSN" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="gross_monthly_income" class="control-label">Gross Monthly Income</label>
                <input type="text" class="form-control" id="gross_monthly_income" name="gross_monthly_income" required>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="email" class="control-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="phone" class="control-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone Number" required>
            </div>
        </div>
    </div>

    <hr>

	<div class="form-group"> <!-- Street 1 -->
		<label for="street_address" class="control-label">Street Address</label>
		<input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street address, P.O. box, company name, c/o">
	</div>					
							
	<!-- <div class="form-group">
		<label for="street2_id" class="control-label">Street Address 2</label>
		<input type="text" class="form-control" id="street2_id" name="street2" placeholder="Apartment, suite, unit, building, floor, etc.">
    </div> -->
    
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="city" class="control-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="state" class="control-label">State</label>
                <select class="form-control" id="state" name="state">
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
            <div class="form-group">
                <label for="zip" class="control-label">Zip Code</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code">
            </div>		
        </div>
    </div>

    <hr>

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="loan_type" class="control-label">Loan Type</label>
                <select class="form-control" id="loan_type" name="loan_type">
                    <?php foreach($loanTypes as $loanType): ?>
                        <option value="<?= $loanType['id']; ?>"><?= $loanType['loan_type']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="amount" class="control-label">Loan Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Loan Amount" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="rate" class="control-label">Interest Rate</label>
                <input type="text" class="form-control" id="rate" name="rate">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="term" class="control-label">Loan Term</label>
                <input type="text" class="form-control" id="term" name="term" placeholder="term">
            </div>
        </div>
    </div>

	<div class="form-group"> <!-- Submit Button -->
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>     
	
</form>