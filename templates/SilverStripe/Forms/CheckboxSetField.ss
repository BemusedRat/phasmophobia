<% if $Options %>
    <div class="row">
        <% loop $Options %>
            <div class="{$Class.ATT} form-check form-check-inline col-sm-4">
                <input
                    id="{$ID.ATT}"
                    class="form-check-input<% if $isChecked %> checked<% end_if %>"
                    name="{$Name.ATT}"
                    type="checkbox"
                    value="{$Value.ATT}"
                    aria-labelledby="option-title-{$ID.ATT}"
                    <% if $isChecked %>checked="checked"<% end_if %>
                    <% if $isDisabled %>disabled="disabled"<% end_if %>
                />
                <label id="option-title-{$ID.ATT}" for="$ID.ATT" class="form-check-label btn">
                    {$Title}
                </label>
            </div>
        <% end_loop %>
    </div>
<% else %>
    <p class="form-text"><%t CWP_Form.NoOptions "No options available" %></p>
<% end_if %>
