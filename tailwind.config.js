module.exports = {
    purge: [],
    theme: {
        extend: {
            width: {
                '1/7': '14.2857143%',
                '2/7': '28.5714286%',
                '3/7': '42.8571429%',
                '4/7': '57.1428571%',
                '5/7': '71.4285714%',
                '6/7': '20rem',
            },
            colors: {
                'regal-blue': '#243c5a',
            },
            spinner: (theme) => ({
                default: {
                    color: '#dae1e7', // color you want to make the spinner
                    size: '1em', // size of the spinner (used for both width and height)
                    border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
                    speed: '500ms', // the speed at which the spinner should rotate
                },
            }),
        },
    },
    variants: {},
    plugins: [
        // optional configuration for resulting class name and/or tailwind theme key
        require('tailwindcss-spinner')({
            className: 'spinner',
            themeKey: 'spinner'
        }),
    ],
}
