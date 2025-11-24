import { serveDir } from "https://deno.land/std@0.224.0/http/file_server.ts";

Deno.serve((req) => {
  return serveDir(req, {
    fsRoot: "dist", // serve your Vite build
    urlRoot: "", // serve from root
    enableCors: true,
  });
});
