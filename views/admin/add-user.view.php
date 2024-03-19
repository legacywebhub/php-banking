<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add User</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form method="post" name="adduser-form">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>"> 
                    <div class="form-group">
                        <div class="section-title">First Name <span class="text-danger">*</span></div>
                        <input type="text" maxlength="30" name="firstname" class="form-control" onkeypress="return onlyAlphabeticalKey(event)" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Last Name <span class="text-danger">*</span></div>
                        <input type="text" maxlength="30" name="lastname" class="form-control" onkeypress="return onlyAlphabeticalKey(event)" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Email <span class="text-danger">*</span></div>
                        <input type="email" maxlength="90" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Phone </div>
                        <input type="text" maxlength="30" name="phone" class="form-control">
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <div class="section-title">Address </div>
                            <input type="address" maxlength="100" name="address" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <div class="section-title">Country </div>
                            <select class="form-control" name="country">
                                <option value="">select</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Aland Islands">Aland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, Democratic Republic of the Congo">Congo, Democratic Republic of the Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curacao">Curacao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin">Saint Martin</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Sint Maarten">Sint Maarten</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <div class="section-title">Account Type </div>
                            <select class="form-control" name="acc-type">
                                <option value="Savings">Savings</option>
                                <option value="Checking">Checking</option>
                            </select>

                        </div>
                        <div class="form-group col-6">
                            <div class="section-title">Account Currency <span class="text-danger">*</span></div>
                            <select class="form-control" name="currency" required>
                                <option value="$">Dollar</option>
                                <option value="€">Euro</option>
                                <option value="¥">Yen</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Password <span class="text-danger">*</span></div>
                        <input type="password" maxlength="30" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Confirm Password <span class="text-danger">*</span></div>
                        <input type="password" maxlength="30" name="password-confirm" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_staff" id="staff">
                        <label class="form-check-label" for="staff">
                          Is Staff
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_superuser" id="superuser">
                        <label class="form-check-label" for="superuser">
                          Is Superuser
                        </label>
                    </div>
                    <h5 class="message my-3" style="display: flex; justify-content: center;"></h5>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary"><span class="btn-text">Save</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- InPage script -->
  <script>
    let addUserForm = document.forms['adduser-form'],
    formBtn = addUserForm.querySelector('.btn-lg'),
    btnText = formBtn.querySelector('.btn-text'),
    msgBox = document.querySelector('.message');

    addUserForm.addEventListener('submit', (e)=>{
        e.preventDefault()

        let data = {
            'firstname': addUserForm['firstname'].value,
            'lastname': addUserForm['lastname'].value,
            'email': addUserForm['email'].value,
            'phone': addUserForm['phone'].value,
            'address': addUserForm['address'].value,
            'country': addUserForm['country'].value,
            'timezone': Intl.DateTimeFormat().resolvedOptions().timeZone,
            'account_type': addUserForm['acc-type'].value,
            'currency': addUserForm['currency'].value,
            'password1': addUserForm['password'].value,
            'password2': addUserForm['password-confirm'].value,
            'is_staff': addUserForm['is_staff'].checked ? 1 : 0, 
            'is_superuser': addUserForm['is_superuser'].checked ? 1 : 0,
            'csrf_token': addUserForm['csrf_token'].value,
        };

        if(data['firstname']=="" || data['lastname']=="" ||  data['email']=="" || data['account_type']=="" || data['currency']=="" || data['password1']=="" || data['password2']==""){
            displayErrorMessage('Enter all field');
        }

        if(data['password1'] != data['password2']) {
            displayErrorMessage('Password does not match !');
        }

        if(data['password1'].length < 5 || data['password2'].length < 5) {
            displayErrorMessage('Enter A Stronger Password !');
        }

        // Loading animation
        btnText.innerHTML = `Saving data...<img width='30px' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
        formBtn.disabed = true;
        console.log(data);

        fetch(window.location.href, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then((response)=>{
            return response.json()
        })
        .then((data)=>{
            console.log(data);
            formBtn.disabed = false;
            if (data['status'] == 'success') {
                addUserForm.reset();
                btnText.innerHTML = `Save`;
                displayMessageElement(msgBox, "success", data['message']);
                swal(`Success`, data['message'], 'success');
            } else {
                btnText.innerHTML = `Save`;
                displayMessageElement(msgBox, "danger", data['message']);
            }
        })
        .catch((err)=>{
            console.log(err);
            formBtn.disabed = false;
            btnText.innerHTML = `Save`;
            displayMessageElement(msgBox, "danger", "An error occured");
        })
    })
  </script>