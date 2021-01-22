<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">
			$Content

			<ul>
				<% loop EvidencedGhosts %>
						<li>
							<h3>$Name</h3>

							<% if RequiredEvidence %>
								<h5>Required Evidence</h5>
								<ul class="required-evidence-list">
									<% loop RequiredEvidence %>
										<li>$Name</li>
									<% end_loop %>
								</ul>
							<% end_if %>

							<!--<h5>All Evidence</h5>
							<ul class="ghost-evidence-list">
							<% loop EvidenceTypes %>
								<li>$Name</li>
							<% end_loop %>
							</ul>-->
						</li>
				<% end_loop %>
			</ul>
			<div>
				$EvidenceForm
			</div>

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

		</div>
	</article>
		
		$Form
		$CommentsForm
</div>