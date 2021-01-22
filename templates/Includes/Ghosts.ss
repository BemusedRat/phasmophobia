<div class="ghosts<% if EvidencedGhosts %> row<% end_if %>">
    <% if EvidencedGhosts %>
        <% loop EvidencedGhosts %>
            <div class="ghost col-sm-4">
            <div class="card<% if $Top.OnlyGhost %> bg-success text-white<% end_if %>">
                    <div class="card-body">
                        <h5 class="card-title">$Name</h5>

                        <% if RequiredEvidence %>
                            <ul class="required-evidence-list">
                                <% loop RequiredEvidence %>
                                    <li>$Name</li>
                                <% end_loop %>
                            </ul>
                        <% else %>
                            <ul class="evidence">
                                <% loop EvidenceTypes %>
                                    <li>$Name</li>
                                <% end_loop %>
                        <% end_if %>

                        <!--<h5>All Evidence</h5>
                        <ul class="ghost-evidence-list">
                        <% loop EvidenceTypes %>
                            <li>$Name</li>
                        <% end_loop %>
                        </ul>-->
                    </div>
                </div>
            </div>
        <% end_loop %>
    <% else %>
        <div class="alert alert-warning col-sm-6">
            No ghosts match that evidence combination. Please try again.
        </div>
    <% end_if %>
</div>