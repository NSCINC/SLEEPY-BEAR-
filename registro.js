const express = require('express');
const bodyParser = require('body-parser');
const twilio = require('twilio');
const app = express();
app.use(bodyParser.json());

const accountSid = 'your_account_sid';
const authToken = 'your_auth_token';
const client = twilio(accountSid, authToken);

const verificationCodes = {}; // Usado para armazenar os códigos de verificação temporariamente

app.post('/send-code', (req, res) => {
    const { phone } = req.body;
    const code = Math.floor(100000 + Math.random() * 900000); // Gera um código de 6 dígitos

    verificationCodes[phone] = code;

    client.messages.create({
        body: `Seu código de verificação é ${code}`,
        from: 'your_twilio_phone_number',
        to: phone
    }).then(message => res.json({ success: true }))
      .catch(err => res.status(500).json({ success: false, error: err.message }));
});

app.post('/verify-code', (req, res) => {
    const { phone, code } = req.body;
    if (verificationCodes[phone] && verificationCodes[phone] === parseInt(code, 10)) {
        res.json({ success: true });
    } else {
        res.status(400).json({ success: false, message: 'Código inválido' });
    }
});

app.listen(3000, () => console.log('Servidor rodando na porta 3000'));
