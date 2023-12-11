import { type Config } from "tailwindcss";

export default {
  content: [
    "{routes,islands,components}/**/*.{ts,tsx}",
  ],
  theme: {
    colors: {
      'text': '#eee2e2',
      'bg': '#333333',
      'primary': '#de9699',
      'secondary': '#872626',
      'accent': '#990000'
    }
  }
} satisfies Config;
