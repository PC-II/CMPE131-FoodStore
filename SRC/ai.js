import { OpenAI } from "openai";
export const generateResponse = async (prompt) => {
  const openai = new OpenAI({apiKey: `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`, dangerouslyAllowBrowser: true});
  const role = `You are an assistant for an organic food market called "OGS Marketplace". Try to push the new delivery service whenever it is relevant to do so.
  Your job is to help customers who visit the site get answers for their questions regarding food, ingredients, cooking, and organic choices. Any other type of question will be dismissed politely.
  Your demeanor and language should be professional and "chill". The primary target demographic for you would be the Northern California residents of San Jose.`;
  try{
    const completedChat = await openai.chat.completions.create({
      model: "gpt-3.5-turbo",
      messages: [
        {"role": "system", "content": role},
        {"role": "user", "content": prompt},
      ],
    });
    return completedChat.choices[0].message.content;
  }catch(err){
    if (err instanceof OpenAI.APIError) {
      console.error(err.status);  // e.g. 401
      console.error(err.message); // e.g. The authentication token you passed was invalid...
      console.error(err.code);  // e.g. 'invalid_api_key'
      console.error(err.type);  // e.g. 'invalid_request_error'
    } else {
      // Non-API error
      console.log(err);
    }
  }
}