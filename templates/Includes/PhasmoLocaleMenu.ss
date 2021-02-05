<% if $Locales %>
<div class="float-right">
    <nav class="primary">
        <ul>
            <% loop $Locales %>
                <li class="$LinkingMode LanguageFlag">
                    <a href="$Link.ATT" <% if $LinkingMode != 'invalid' %>rel="alternate"
                       hreflang="$HrefLang"<% end_if %>><img src="bemusedrat/phasmophobia/assets/flags/24x24/en_AU.png" alt="$Title.XML" /></a>
                </li>
            <% end_loop %>
        </ul>
    </nav>
</div>
<% end_if %>