<div class="ui segment">
  <h3><center><div class="ui yellow horizontal label big ">New Facility Details</div></center></h3>
</div>
<div class="ui segment">
    <form class="ui form">
        <div class="two fields">
            <div class="field">
              <div class="ui horizontal label large ">Facility Name</div><div class="field"></div>
              <input type="text" value="" ng-model="facility_detail.name">
            </div>
            <div class="field">
                <div class="ui horizontal label large ">MFL Code</div><div class="field"></div>
                <input type="text" value="" ng-model="facility_detail.mfl_code">
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
                <div class="ui horizontal label large "> Sub County</div><div class="field"></div>
                    <ui-select on-select="sub_county_change()" ng-model="selected.sub_county" theme="selectize" >
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
                <div class="ui horizontal label large "> Partner </div><div class="field"></div>
                <ui-select on-select="partner_change()" ng-model="selected.partner" theme="selectize" >
                    <ui-select-match placeholder="Select a Partner"> {{ $select.selected.name }}</ui-select-match>
                        <ui-select-choices  repeat="partner in partners | filter: $select.search">
                            <span ng-bind-html="partner.name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div>
            <div class="field">
                <div class="ui horizontal label large "> Central Site</div><div class="field"></div>
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
                <div class="ui horizontal label large "> Facility Type  </div><div class="field"></div>
                <ui-select on-select="ftype_change()" ng-model="selected.ftype" theme="selectize" >
                    <ui-select-match placeholder="Select a Facility Type"> {{ $select.selected.name }}</ui-select-match>
                        <ui-select-choices  repeat="partner in partners | filter: $select.search">
                            <span ng-bind-html="partner.name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div><div class="field"></div>
        </div>
        <div class="ui primary button"> Save Details </div>
        <button class="ui button" ng-click="backFacilities()"> Back To Facilities </button>
        {{ facility_detail }}
        <div style="height:50px"></div>
</form>
</div>
