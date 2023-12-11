import { PageProps } from "$fresh/server.ts";
import { Background } from "../../components/Background.tsx";

export default function Recipes(props: PageProps) {
  const { id } = props.params;
  const markdownContent = `
    # Welcome to My App

    This is a **Markdown** file that we'll convert to JSX.
  `;

  return (
    <Background>
      <p>Greetings to you, {id}!</p>
      <>{loader(markdownContent)}</>
    </Background>
  );
}
