(() => {
    "use strict";

    document.addEventListener("DOMContentLoaded", function () {
        var selectors = "a[data-codepen], button[data-codepen]";
        var elements = document.querySelectorAll(selectors);

        elements.forEach(function (element) {
            element.addEventListener("click", function () {
                var dataCodepenUrl = element.getAttribute("data-codepen");
                openCodepen(dataCodepenUrl ? resolveUrl(dataCodepenUrl, window.location.href) : window.location.href);
            });
        });

        function openCodepen(url) {
            var newWindow = window.open("", "_blank");
            fetchContent(url, function (responseText) {
                var parsedContent = parseContent(responseText, url);
                submitToCodepen(newWindow, parsedContent);
            });
        }

        function fetchContent(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    callback(xhr.responseText);
                }
            };
            xhr.send();
        }

        function parseContent(content, baseUrl) {
            var bodyMatch = /<body([^>]*)>([\s\S]*)<\/body>/.exec(content);
            var scripts = extractTags(content, /<script([^>]*)>([\s\S]*?)<\/script>/g, "src", true, baseUrl);
            var styles = extractTags(content, /<style([^>]*)>([\s\S]*?)<\/style>/g, null, false, baseUrl, cleanCSS);
            var links = extractTags(content, /<link([^>]*)>/g, "href", false, baseUrl, null, "stylesheet", "print");

            return {
                html: bodyMatch ? dedent(replaceLocalPaths(cleanHTML(bodyMatch[2]), baseUrl)) : "",
                css: styles.join("\n\n"),
                js: scripts.inline.join("\n\n"),
                js_external: scripts.external.filter(filterExternalJS).join(";"),
                css_external: links.external.filter(filterExternalCSS).join(";"),
                editors: calculateEditors(bodyMatch, styles, scripts.inline)
            };
        }

        function extractTags(content, regex, attribute, isScript, baseUrl, transform, relFilter, mediaFilter) {
            var match, external = [], inline = [];
            while ((match = regex.exec(content)) !== null) {
                var attrValue = attribute ? getAttributeValue(match[1], attribute) : null;
                if (isScript && attrValue) {
                    external.push(resolveUrl(attrValue, baseUrl));
                } else {
                    var textContent = dedent(transform ? transform(match[2], baseUrl) : match[2]);
                    if (textContent) {
                        inline.push(textContent);
                    }
                }
            }
            return { external, inline };
        }

        function getAttributeValue(tag, attribute) {
            var regex = new RegExp(attribute + `\\s*=\\s*['"]([^'"]+)['"]`);
            var match = regex.exec(tag);
            return match ? match[1] : null;
        }

        function cleanCSS(css) {
            return css.replace(/\.demo-topbar[^{]*\{[^}]*?\}/g, "");
        }

        function cleanHTML(html) {
            return html.replace(/<div[^>]+class\s*=\s*['"]demo-topbar['"][\s\S]*?<\/\s*div\s*>/gi, "")
                       .replace(/<(a|button)[^>]+data-codepen[^>]*>[\s\S]*?<\/\s*\1\s*>/gi, "");
        }

        function replaceLocalPaths(content, baseUrl) {
            const url = new URL(baseUrl);
            return content.replace(/(?<=['"])\/api\//g, `${url.protocol}//${url.host}/api/`);
        }

        function dedent(text) {
            var indentMatch = /^[\t ]+/gm.exec(text);
            if (!indentMatch) return text.trim();

            var indent = indentMatch[0];
            var lines = text.split('\n');
            return lines.map(line => line.startsWith(indent) ? line.slice(indent.length) : line).join('\n').trim();
        }

        function resolveUrl(path, baseUrl) {
            if (path.match(/^(\w+:\/\/([^\/]+))(.*)$/)) {
                return path;
            }
            var base = baseUrl.match(/^(\w+:\/\/([^\/]+))(.*)$/);
            if (!base) return path;

            var baseParts = base[2].split('/');
            var pathParts = path.split('/');
            baseParts.pop();

            for (var part of pathParts) {
                if (part === '.') continue;
                if (part === '..') baseParts.pop();
                else baseParts.push(part);
            }

            return base[1] + baseParts.join('/');
        }

        function filterExternalJS(url) {
            return !url.match(/\/demo-to-codepen\.js$/) && !url.match(/cloudflare|google|\/pre\//);
        }

        function filterExternalCSS(url) {
            return !url.match(/\/demo-to-codepen\.css$/);
        }

        function calculateEditors(htmlBody, css, js) {
            return `${htmlBody ? '1' : '0'}${css.length ? '1' : '0'}${js.length ? '1' : '0'}`;
        }

        function submitToCodepen(window, content) {
            window.document.open();
            window.document.write(`
                <html>
                <body>
                    <form action="https://codepen.io/pen/define" method="POST">
                        <input type="hidden" name="data" value="${escapeHTML(JSON.stringify(content))}" />
                    </form>
                    <script>document.forms[0].submit()</script>
                </body>
                </html>
            `);
            window.document.close();
        }

        function escapeHTML(text) {
            return text.replace(/&/g, "&amp;")
                       .replace(/</g, "&lt;")
                       .replace(/>/g, "&gt;")
                       .replace(/'/g, "&#039;")
                       .replace(/"/g, "&quot;")
                       .replace(/\n/g, "<br />");
        }
    });
})();
