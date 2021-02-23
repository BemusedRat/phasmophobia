<div class="container">
    <div>
        <section class="<% if not $Children %><% end_if %>">
			<div class="content">
				$Content
			</div>
			<div>
				$EvidenceForm
			</div>
			<% include Ghosts %>
			<%--
			<h2>Ghosts</h2>
			<ul class="ghosts-list">
				<% loop Ghosts %>
					<li>
						<h3>$Name</h3>
						<ul class="ghost-evidence-list">
						<% loop EvidenceTypes %>
							<li>$Name</li>
						<% end_loop %>
						</ul>
					</li>
				<% end_loop %>
			</ul>

			<h2>Evidence</h2>
			<ul class="evidence-list">
				<% loop EvidenceTypes %>
					<li>
						<h3>$Name</h3>
						<ul class="evidence-ghost-list">
						<% loop Ghosts %>
							<li>$Name</li>
						<% end_loop %>
						</ul>
					</li>
				<% end_loop %>
			</ul>
            $Form
            <% include RelatedPages %>
            $CommentsForm
        </section>
        <% if $Children %>
        <aside class="col-lg-3 offset-lg-1">
            <% include SidebarNav %>
        </aside>
		<% end_if %>
		--%>
    </div>
</div>
<!-- include PageUtilities -->
