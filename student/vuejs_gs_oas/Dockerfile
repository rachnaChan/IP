FROM node:18.6.0-alpine3.16
WORKDIR app
COPY . .
RUN npm install
EXPOSE 5173
CMD [ "npm", "run", "dev", "--", "--host", "0.0.0.0" ]



