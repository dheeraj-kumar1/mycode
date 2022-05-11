@csrf
<div class="form-group row">
    <div class="col-md-2">
        <label for="title">Title<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            placeholder="Enter client title" value="{{ old('title') ?? $client->title }}" />
        @error('title')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-10">
        <label for="full_name">Full Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name"
            placeholder="Enter client full name" value="{{ old('full_name') ?? $client->full_name }}" />
        @error('full_name')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label for="first_name">First Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
            placeholder="Enter client first name" value="{{ old('first_name') ?? $client->first_name }}" />
        @error('first_name')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="surname">Last Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"
            placeholder="Enter client last name" value="{{ old('surname') ?? $client->surname }}" />
        @error('surname')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="friendly_name">Friendly Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('friendly_name') is-invalid @enderror" name="friendly_name"
            placeholder="Enter client friendly name" value="{{ old('friendly_name') ?? $client->friendly_name }}" />
        @error('friendly_name')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
        <label for="mobile_phone">Mobile Phone<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone"
            placeholder="Enter client mobile phone" value="{{ old('mobile_phone') ?? $client->mobile_phone }}" />
        @error('mobile_phone')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="home_phone">Home Phone</label>
        <input type="text" class="form-control" name="home_phone" id="home_phone"
            placeholder="Enter client home phone" value="{{ old('home_phone') ?? $client->home_phone }}" />
    </div>
    <div class="col-md-3">
        <label for="work_phone">Work Phone<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('work_phone') is-invalid @enderror" name="work_phone"
            placeholder="Enter client work phone" value="{{ old('work_phone') ?? $client->work_phone }}" />
        @error('work_phone')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="fax">Fax<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('fax') is-invalid @enderror" name="fax"
            placeholder="Enter client fax" value="{{ old('fax') ?? $client->fax }}" />
        @error('fax')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label for="email">Email<span class="text-danger">*</span></label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            placeholder="Enter client email" value="{{ old('email') ?? $client->email }}" />
        @error('email')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="company_name">Company Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name"
            placeholder="Enter client company name" value="{{ old('company_name') ?? $client->company_name }}" />
        @error('company_name')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="group_name">Select Group<span class="text-danger">*</span></label>
        <select class="selectpicker form-control @error('group_id') is-invalid @enderror" data-live-search="true"
            name="group_id">
            <option selected disabled>Please select group name</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}"
                    {{ (old('group_id') == $group->id ? 'selected' : '')}}{{($client->group_id == $group->id ? 'selected' : '') }}>
                    {{ $group->group_name }}</option>
            @endforeach
        </select>
        @error('group_id')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="notes">Notes<span class="text-danger">*</span></label>
    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes"
        placeholder="Enter client notes">{{ old('notes') ?? $client->notes }}</textarea>
    @error('notes')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="address_line1">Address Line 1</label>
        <input type="text" class="form-control" name="address_line1" id="address_line1"
            placeholder="Enter client address line 1" value="{{ old('address_line1') ?? $client->address_line1 }}" />
    </div>
    <div class="col-md-4">
        <label for="address_line2">Address Line 2</label>
        <input type="text" class="form-control" name="address_line2" placeholder="Enter client address line 2"
            value="{{ old('address_line2') ?? $client->address_line2 }}" />
    </div>
    <div class="col-md-4">
        <label for="town">Town/City</label>
        <input type="text" class="form-control" name="town" placeholder="Enter client town"
            value="{{ old('town') ?? $client->town }}" />
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="county">County</label>
        <input type="text" class="form-control" name="county" id="county" placeholder="Enter client county"
            value="{{ old('county') ?? $client->county }}" />
    </div>
    <div class="col-md-4">
        <label for="postcode">Postcode</label>
        <input type="text" class="form-control" name="postcode" placeholder="Enter client postcode"
            value="{{ old('postcode') ?? $client->postcode }}" />
    </div>
    <div class="col-md-4">
        <label for="country">Country</label>
        <input type="text" class="form-control" name="country" placeholder="Enter client country"
            value="{{ old('country') ?? $client->country }}" />
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="date_registered">Date registered</label>
        <input type="date" class="form-control" name="date_registered" id="date_registered"
            placeholder="Enter client date registered"
            value="{{ old('date_registered') ?? $client->date_registered }}" />
    </div>
    <div class="col-md-4">
        <label for="registration_complete">Registration Complete</label>
        <input type="date" class="form-control" name="registration_complete"
            placeholder="Enter client registration complete"
            value="{{ old('registration_complete') ?? $client->registration_complete }}" />
    </div>
    <div class="col-md-4">
        <label for="reg_website">Registered via Website?</label>
        <select class="form-control" name="reg_website">
            <option value="Yes"
                {{ (old('reg_website') == 'Yes' ? 'selected' : '') ?? ($client->reg_website == 'Yes' ? 'selected' : '') }}>
                Yes</option>
            <option value="No"
                {{ (old('reg_website') == 'No' ? 'selected' : '') ?? ($client->reg_website == 'No' ? 'selected' : '') }}>
                No</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="branches">Branches</label>
        <input type="text" class="form-control" name="branches" id="branches" placeholder="Enter client branches"
            value="{{ old('branches') ?? $client->branches }}" />
    </div>
    <div class="col-md-4">
        <label for="source">Source</label>
        <input type="text" class="form-control" name="source" placeholder="Enter client source"
            value="{{ old('source') ?? $client->source }}" />
    </div>
    <div class="col-md-4">
        <label for="grouping">Grouping</label>
        <input type="text" class="form-control" name="grouping" placeholder="Enter client grouping"
            value="{{ old('grouping') ?? $client->grouping }}" />
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="property_email">Property Details via Email?</label>
        <select class="form-control" name="property_email" id="property_email">
             <option value="Yes" {{(old('property_email') == 'Yes' ? 'selected' : '') ?? ($client->property_email == 'Yes' ? 'selected' : '') }}>Yes</option>
            <option value="No" {{(old('property_email') == 'No' ? 'selected' : '') ?? ($client->property_email == 'No' ? 'selected' : '') }}>No</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="property_sms">Property Details via SMS?</label>
        <select class="form-control" name="property_sms" id="property_sms">
             <option value="Yes" {{(old('property_sms') == 'Yes' ? 'selected' : '') ?? ($client->property_sms == 'Yes' ? 'selected' : '') }}>Yes</option>
            <option value="No" {{(old('property_sms') == 'No' ? 'selected' : '') ?? ($client->property_sms == 'No' ? 'selected' : '') }}>No</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="other_marketing">Other Marketing via Email?</label>
        <select class="form-control" name="other_marketing" id="other_marketing">
             <option value="Yes" {{(old('other_marketing') == 'Yes' ? 'selected' : '') ?? ($client->other_marketing == 'Yes' ? 'selected' : '') }}>Yes</option>
            <option value="No" {{(old('other_marketing') == 'No' ? 'selected' : '') ?? ($client->other_marketing == 'No' ? 'selected' : '') }}>No</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="consent_updated">Consent Last Updated</label>
        <input type="date" class="form-control" name="consent_updated" id="consent_updated"
            placeholder="Enter client consent updated"
            value="{{ old('consent_updated') ?? $client->consent_updated }}" />
    </div>
    <div class="col-md-4">
        <label for="consent_link">Manage Consent Link</label>
        <input type="text" class="form-control" name="consent_link" placeholder="Enter client consent link"
            value="{{ old('consent_link') ?? $client->consent_link }}" />
    </div>
    <div class="col-md-4">
        <label for="delete_before">Do not Delete Before </label>
        <input type="date" class="form-control" name="delete_before" id="delete_before"
            placeholder="Enter client delete before" value="{{ old('delete_before') ?? $client->delete_before }}" />
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="finance_status">Finance Status</label>
        <input type="text" class="form-control" name="finance_status" placeholder="Enter client finance status"
            value="{{ old('finance_status') ?? $client->finance_status }}" />
    </div>
    <div class="col-md-6">
        <label for="finance_status_notes">Finance Status Notes</label>
        <input type="text" class="form-control" name="finance_status_notes"
            placeholder="Enter client finance status notes"
            value="{{ old('finance_status_notes') ?? $client->finance_status_notes }}" />
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="chain_status">Chain Status</label>
        <input type="text" class="form-control" name="chain_status" placeholder="Enter client chain status"
            value="{{ old('chain_status') ?? $client->chain_status }}" />
    </div>
    <div class="col-md-6">
        <label for="chain_status_notes">Chain Status Notes</label>
        <input type="text" class="form-control" name="chain_status_notes"
            placeholder="Enter client chain status notes"
            value="{{ old('chain_status_notes') ?? $client->chain_status_notes }}" />
    </div>
</div>
