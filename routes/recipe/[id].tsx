import { PageProps } from "$fresh/server.ts";
import { MDXProvider } from '@mdx-js/preact';
import { compile, run } from "@mdx-js/mdx";
import remarkGfm from "remark-gfm";
import { h, Fragment } from "preact";

// import { walkSync } from "https://deno.land/std@0.208.0/fs/mod.ts";
// import { encode } from "https://deno.land/std/encoding/base64.ts";

import { Background } from "../../components/Background.tsx";

// const contentPath = "./content";
// const mapping: {[key: string]: string} = {};

// for (const entry of walkSync(contentPath, { exts: [".md"] })) {
// 	const uuid: string = encode(new Uint8Array(await crypto.subtle.digest("SHA-256", new TextEncoder().encode(entry.path))));
// 	mapping[uuid] = entry.path;
// }

// async function handleRecipeRequest(id: string): Promise<h.JSX.Element> {
//   if (mapping[id]) {
//     const filePath = mapping[id];
//     const markdown = await Deno.readTextFile(filePath);
// 	const code = String(await compile(markdown, { 
// 		outputFormat: 'function-body',
// 		remarkPlugins: [remarkGfm]
// 	}));

// 	const runtime = {
// 		jsx: h,
// 		jsxs: h,
// 		jsxDEV: h,
// 		Fragment,
// 	};
// 	const {default: Content} = await run(code, runtime);
  
// 	const mdxComponents = {};
    
// 	return ( 
//   		<MDXProvider components={mdxComponents}>
// 			<Content />
// 	  	</MDXProvider>
// 	);
//   } else {
//     return <>{"Recipe not found!"}</>;
//   }
// }

const markdown = await Deno.readTextFile("./content/recipes/example.mdx");
const code = String(await compile(markdown, { 
	outputFormat: 'function-body',
	remarkPlugins: [remarkGfm]
}));

const runtime = {
	jsx: h,
	jsxs: h,
	jsxDEV: h,
	Fragment,
};
const {default: Content} = await run(code, runtime);
console.log("Content", Content);

// http://localhost:8000/recipe/f3898c49-a049-486b-878d-4db82202f97c
// http://localhost:8000/recipe/Ni0Pn4ATLUiZLMpOSUKs0w

export default function Recipes(props: PageProps) {
  	const { id } = props.params;
	const mdxComponents = {};

  	return (
		<Background>
			<p>Greetings to you, {id} from params!</p>
			<MDXProvider components={mdxComponents}>
				<Content />
			</MDXProvider>
		</Background>
	);
}
