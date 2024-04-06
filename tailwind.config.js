/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resource/**/*.blade.php"],
    theme: {
        extend: {
            colors: {
                bg: "",
            },
            spacing: {
                "7p": "12%",
            },
            fontFamily: {
                poppins: "poppins, sans-serif",
                comfortaa: "Comfortaa, sans-serif",
            },
        },
    },
    plugins: [],
};
