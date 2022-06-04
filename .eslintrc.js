// eslint-disable-next-line no-undef
module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: ['eslint:recommended', 'plugin:vue/recommended'],
    parserOptions: {
        ecmaVersion: 13,
        sourceType: 'module',
    },
    plugins: ['vue'],
    rules: {
        indent: ['error', 2],
        'linebreak-style': ['error', 'unix'],
        quotes: ['error', 'single', { 'avoidEscape': true , 'allowTemplateLiterals': true }],
        semi: ['error', 'never'],
        'vue/order-in-components': ['error'],
        'vue/max-attributes-per-line': ['error', {
            'singleline': 5,
            'multiline': 5
        }],
        'vue/singleline-html-element-content-newline': ['error', {
            'ignoreWhenNoAttributes': true,
            'ignoreWhenEmpty': true,
            'ignores': ['a', 'v']
        }],
        'vue/html-self-closing': ['error', {
            'html': {
                'void': 'never',
                'normal': 'always',
                'component': 'always'
            },
            'svg': 'always',
            'math': 'always'
        }],
        'vue/valid-v-slot': ['error', { 'allowModifiers': true }]
    },
}
