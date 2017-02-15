<div class="panel-heading panel-child">FORM ELEMENT</div>
                    <div class="panel-body">
                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Field Type</label>
                            <div class="col-sm-8">
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type' value="text" checked="checked"> Text
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type'  value="textarea"> Textarea
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type'  value="richtext"> RichText
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type'  value="calendar"> Calendar
                                    </label>
                                </div>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type'  value="dropdown"> Dropdown
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='field_type'  value="checkbox"> Checkbox
                                    </label><label class="radio-inline">
                                        <input type="radio" name='field_type'  value="radiobutton"> Radio Button
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Label Name</label>
                            <div class="col-sm-8">
                                <input name="label" type="text" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Required</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input name="required" type="radio" value="yes"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input name='required' type="radio" value="no"  checked="no"> No
                                </label>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Default Value</label>
                            <div class="col-sm-8">
                                <input name="default_value" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Placeholder</label>
                            <div class="col-sm-8">
                                <input name="placeholder" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Unique Identifier</label>
                            <div class="col-sm-8">
                                <input name="identifier" type="text" class="form-control"  required/>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Dropdown List</label>
                            <div class="col-sm-8">
                                <label class='radio-inline'>
                                    <input type="radio" name="list_predefined" id="optionsRadios1" value="predefined" checked>
                                    Predefined
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="list_predefined" id="optionsRadios1" value="reference_list">
                                    Reference List
                                </label>
                            </div>
                        </div>

                        <div id='predefinedList'>
                            <div class='prelist0'>
                                <div class="form-group form-group-sm input-list">
                                    <label class="control-label col-sm-4">Predefined Value</label>
                                    <div class="col-sm-2 list-padding-right">
                                        <input type='text' class='form-control' placeholder='value'/>
                                    </div>
                                    <div class="col-sm-4 list-padding-left">
                                        <input type='text' class='form-control' placeholder='label / title' />
                                    </div>
                                    <div class='col-sm-2 predefinedActionButton' data-listid='0'>
                                        <div class='btn btn-default btn-sm addPredefined' data-listid='0'><i class='glyphicon glyphicon-plus'></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id='referenceList' class='hidden'>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-4">Reference Table/List</label>
                                <div class="col-sm-8">
                                    <input type='text' class='form-control' name='reference_list' placeholder='refrence table/list'/>
                                </div>
                            </div>
                        </div>

                    </div>
