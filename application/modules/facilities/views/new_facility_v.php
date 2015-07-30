<div class="ui segment">
  <h3><center><div class="ui yellow horizontal label big ">New Facility Details (Fields marked with <i class="asterisk red icon"></i> are Required)</div></center></h3>
</div>
<div class="ui segment">
    <form class="ui form" id="new_facility">
        <div class="two fields">
            <div class="field">
              <div class="ui horizontal label large ">Facility Name <i class="asterisk red icon"></i></div><div class="field"></div>
              <input type="text" id="facility" ng-model="facility_detail.name">
            </div>
            <div class="field">
                <div class="ui horizontal label large ">MFL Code <i class="asterisk red icon"></i></div><div class="field"></div>
                <input type="text" id="mflcode" ng-model="facility_detail.mfl_code">
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <div class="ui horizontal label large ">Email Address</div><div class="field"></div>
                <input type="text" value="" ng-model="facility_detail.email">
            </div>
            <div class="field">
                <div class="ui horizontal label large ">Phone</div><div class="field"></div>
                <input type="text" value="" ng-model="facility_detail.phone">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <div class="ui horizontal label large "> Sub County <i class="asterisk red icon"></i></div><div class="field"></div>
                    <ui-select on-select="sub_county_change()" ng-model="selected.sub_county" theme="selectize" id="sub_county" data-content="You can use me to enter data">
                    <ui-select-match placeholder="Select a Sub County"> {{ $select.selected.name }}</ui-select-match>
                        <ui-select-choices  repeat="sub_county in sub_counties | filter: $select.search">
                            <span ng-bind-html="sub_county.name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div>
            <div class="field">
                <div class="ui horizontal label large "> County </div><div class="field"></div>
                    <input type="text" name="county" readonly value="{{ facility_detail.county_name }}">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <div class="ui horizontal label large "> Partner <i class="asterisk red icon"></i></div><div class="field"></div>
                <ui-select on-select="partner_change()" ng-model="selected.partner" theme="selectize" >
                    <ui-select-match placeholder="Select a Partner"> {{ $select.selected.name }}</ui-select-match>
                        <ui-select-choices  repeat="partner in partners | filter: $select.search">
                            <span ng-bind-html="partner.name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div>
            <div class="field">
                <div class="ui horizontal label large "> Central Site <i class="asterisk red icon"></i></div><div class="field"></div>
                <ui-select on-select="central_change()" ng-model="selected.central" theme="selectize" >
                    <ui-select-match placeholder="Select a Central Site"> {{ $select.selected.facility_name }}</ui-select-match>
                        <ui-select-choices  repeat="central_site in central_sites | filter: $select.search">
                            <span ng-bind-html="central_site.facility_name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <div class="ui horizontal label large "> Facility Type <i class="asterisk red icon"></i></div><div class="field"></div>
                <ui-select on-select="ftype_change()" ng-model="selected.ftype" theme="selectize" >
                    <ui-select-match placeholder="Select a Facility Type"> {{ $select.selected.initials }}</ui-select-match>
                        <ui-select-choices  repeat="ftype in facility_types | filter: $select.search">
                            <div ng-bind-html="ftype.initials | highlight: $select.search"></div>
                            <small><span ng-bind-html="ftype.description | highlight: $select.search"></span></small>
                    </ui-select-choices>
                </ui-select>
            </div>
            <div class="field">
                <div class="ui horizontal label large "> Rollout Status <i class="asterisk red icon"></i></div><div class="field"></div>
                <ui-select on-select="roll_outchange()" ng-model="selected.rollout" theme="selectize" >
                    <ui-select-match placeholder="Rollout Facility ?"> {{ $select.selected.name }}</ui-select-match>
                        <ui-select-choices  repeat="choice in rollouts | filter: $select.search">
                            <div ng-bind-html="choice.name | highlight: $select.search"></div>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="ui primary button" ng-click="save_facility()"> Save Details </div>
        <button class="ui button" ng-click="backFacilities()"> Back To Facilities </button>
        <div class="ui error message"></div>
        <!-- {{ facility_detail }} -->
        <div style="height:150px"></div>
</form>
</div>

<script>
(function ($) {
        $('.ui.form').form({
            facility_name: {
                    identifier: 'facility',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter the facility name'
                  }]
            },
            mfl_code: {
                    identifier: 'mflcode',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter the MFL Code for the facility'
                    }]
            }
        });
}(jQuery));
</script>
