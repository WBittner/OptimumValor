import express from "express";
import { Response, Request } from "express";

import path from "path";

// Controllers (route handlers)
import { Api } from "./controllers/api";
const api = new Api();

// Create Express server
const app = express();

// Express configuration
app.set("port", process.env.PORT || 3000);
app.use(express.static(path.join(__dirname, "public"), { maxAge: 31557600000 }));

/**
 * API routes.
 */
app.get("/api/data", send.bind(null, api.dumpData.bind(api)));
app.get("/api/selectionData", send.bind(null, api.getSelectionData.bind(api)));
app.get("/api/build/map/:map/mode/:mode", send.bind(null, api.getBuild.bind(api)));

function send(handler: (req: Request, res: Response) => string, req: Request, res: Response) {
  res.send(handler(req,res));
}

export default app;