<style>
    ol {
        counter-reset: list;
    }
    ol > li {
        list-style: none;
        position: relative;
    }
    ol > li:before {
        counter-increment: list;
        content: counter(list, lower-alpha) ") ";
        position: absolute;
        left: -1.4em;
    }
    </style>