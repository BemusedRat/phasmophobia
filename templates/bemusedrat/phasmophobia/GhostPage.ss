<!doctype html>
<html class="no-js" lang="$ContentLocale">
    <head>
        <% base_tag %>
        <title><% if $MetaTitle %>$MetaTitle.XML<% else %>$Title.XML<% end_if %> | $SiteConfig.Title.XML</title>
        $MetaTags(false)
        <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=10.0,initial-scale=1.0" />
        <% if $RSSLink %>
        <link rel='alternate' type='application/rss+xml' title='RSS' href='$RSSLink'>
        <% end_if %>
		<% include Icons %>
		<% include Requirements %>
    </head>
    <body class="$ClassName bg-dark">
        <header role="banner" class="bg-phasmo">
            <% include PhasmoHeader %>
        </header>
        <main id="main" class="main bg-phasmo pt-4 pb-4" role="main">
            $Layout
        </main>
        <footer class="footer bg-phasmo pt-3 pb-3" role="contentinfo">
            <% include PhasmoFooter %>
        </footer>
        <% require javascript('https://code.jquery.com/jquery-3.4.1.min.js') %>
        <%--<% require themedJavascript('dist/js/main.js') %>--%>
        <% include GoogleAnalytics %>
    </body>
</html>
