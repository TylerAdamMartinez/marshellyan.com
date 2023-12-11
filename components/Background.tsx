import { JSX } from "preact";

export function Background(props: { children: ChildNode }) {
  return (
    <main class="bg-bg text-text">
      {props.children}
    </main>
  );
}
