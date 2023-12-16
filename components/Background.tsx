import { JSX } from "preact";

export function Background(props: { children: JSX.Element[] }) {
  return (
    <main class="bg-bg text-text">
      {props.children}
    </main>
  );
}
